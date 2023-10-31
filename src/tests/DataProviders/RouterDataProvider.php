<?php

declare(strict_types=1);

namespace Tests\DataProviders;

class RouterDataProvider
{
    public function routeNotFoundCases(): array
    {   /*each individual array is going to be passed one by one as an argument to the it_throws_route_not_found_exception method, the 0 index will be the request uri and the first index will be requestMethod and that is working due to the dataProvider */
        return [
            ['/users', 'put'],
            ['/invoice', 'post'],
            ['/users', 'get'],
            ['/users', 'post']
        ];

    }
}