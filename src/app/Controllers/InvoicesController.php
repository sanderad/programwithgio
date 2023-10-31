<?php

declare (strict_types = 1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Views;
use Carbon\Carbon;
use SebastianBergmann\CodeCoverage\Driver\Xdebug2Driver;
use Twig\Environment AS Twig;

class InvoicesController
{
    public function __construct(private Twig $twig) {
    }

    #[Get('/invoices')]
    public function index()
    { 
        $invoices = Invoice::query()->where('status', InvoiceStatus::Paid)->get()->toArray();
        
        return $this->twig->render('invoices/index.twig', ['invoices' => $invoices]);
    }

    #[Get('/invoices/create')]
    public function create(): Views
    { 
        return Views::make('invoices/create');
    }

    #[Post('/invoices/create')]
    public function store()
    {
        $amount = $_POST['amount'];
        var_dump($amount);
    }

    #[Get('/invoices/new')]
    public function new()
    {
        $invoice = new Invoice();

        $invoice->invoice_number = 5;
        $invoice->amount = 20;
        $invoice->status = InvoiceStatus::Pending;

        $invoice->save();

        echo $invoice->id . ', ' . $invoice->due_date->format('m/d/Y');
    }
}
