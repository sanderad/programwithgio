<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }
    
    /** @test */
    public function it_registers_a_route(): void
    {
        // given that we have a router object


        // when we call a register method and provide the arguments
        $this->router->register('get', '/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ]
            ];
        // then we assert route was registered
        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_get_route(): void
    {

        $this->router->get('/users', ['Users', 'index']);

        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ]
            ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {

        $this->router->post('/users', ['Users', 'index']);

        $expected = [
            'post' => [
                '/users' => ['Users', 'index']
            ]
            ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /** @test */
    public function there_are_no_routes_when_router_is_created(): void
    {
        $router = new Router();

        $this->assertEmpty($router->routes());
    }

    /**
     * @test
     * @dataProvider \Tests\DataProviders\RouterDataProvider::routeNotFoundCases
     */
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void
    {
        $users = new class() {
            public function delete(): bool
            {
                return true;
            }
        };

        $this->router->post('/users', [$users::class, 'index']);
        $this->router->get('/users', ['Users', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    /** @test */
    public function it_resolves_route_from_a_closure(): void
    {
        $this->router->get('/users', fn() => [1,2,3]);

        $this->assertEquals(
            [1,2,3],
            $this->router->resolve('/users', 'get'));
    }

    /** @test */
    public function it_resolves_route(): void
    {
        $users = new class() {
            public function index(): array
            {
                return [1,2,3];
            }
        };
        
        $this->router->get('/users', [$users::class, 'index']);

        $this->assertEquals([1,2,3], $this->router->resolve('/users', 'get'));
    }
}