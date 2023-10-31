<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Tickets;
use Generator;

class GeneratorExampleController
{
    public function __construct(private Tickets $ticketsModel) {

    }

    public function index()
    {

        foreach ($this->ticketsModel->all() as $ticket) {
            echo $ticket['id'] . ': ' . $ticket['email'] . '<br />';
        }

       // $numbers = $this->lazyRange(1, 10);

       /* echo $numbers->current();
        echo $numbers->next();
        echo $numbers->current();
        echo $numbers->next();
        echo $numbers->getReturn(); */
    }

   /* public function lazyRange(int $start, int $end): Generator
    {
        for ($i = $start; $i <= $end; $i++) {
            yield $i * 5 => $i;
        }
    }*/
}