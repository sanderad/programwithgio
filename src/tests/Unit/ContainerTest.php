<?php 

declare(strict_types=1);

namespace Tests\Unit;

use App\Container;
use App\Exceptions\Container\ContainerException;
use PHPUnit\Framework\TestCase;
use Tests\ForTests\ClassImplementInterface;
use Tests\ForTests\ClassWithConstruct;
use Tests\ForTests\InterfaceForTests;

class ContainerTest extends TestCase
{
    private Container $container;
    private InterfaceForTests $interface;
    private ClassWithConstruct $classC;
    private ClassImplementInterface $classI;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container();
        //$this->classC = new ClassWithConstruct($this->interface);
        $this->classI = new ClassImplementInterface();
    }

    /**
     * @test
     */
    public function it_sets_class_name_to_id_in_entries_when_using_interfaces(): void
    {


        $this->container->set('myInterface', 'myClass' );

        $entries = [];
        $expected = [
            'myInterface' => 'myClass'
        ];

        $this->assertEquals($expected, $this->container->entries);
    }

    /**
     * @test
     */
    public function it_has_avaliable(): void
    {
        $this->container->set('MyInterface', 'MyClass');

        $this->container->has('MyInterface');

        $expected = 'MyInterface';

        $this->assertEquals($expected,$this->container->has('MyInterface'));
    }

    /**
     * @test
     */
    public function it_gets_what_has_been_registered(): void
    {
        $this->container->set(InterfaceForTests::class, ClassImplementInterface::class);

        $this->container->has(InterfaceForTests::class);

        $expected = $this->classI;

        $resolvedActualInstance = $this->container->get(InterfaceForTests::class);

        $this->assertEquals($expected, $resolvedActualInstance);
    }

    /**
     * @test
     * @dataProvider \Tests\DataProviders\ContainerDataProvider::errorsForResolveMethod
     */
    public function it_throws_errors_when_trying_to_resolve(
        string $test
    ): void
    {
        $this->expectException(ContainerException::class);
        $this->container->resolve($test);
    }
}