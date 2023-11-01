<?php

declare(strict_types=1);

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../eloquent.php';

$invoiceId = 1;

/*this is the base class with restricted autocompletion functionalities present on the Eloquent way of creating queries whose properties are automatically mapped to the proper table names */
$invoices = Capsule::table('invoices')->where('status', InvoiceStatus::Paid)->get();

Invoice::query()->where('id', $invoiceId)->update(['status' => InvoiceStatus::Paid]);

/* get() in this case returns a collection of invoice model, a collection instance which is basically an array and now we have the option to access methos from Collection*/
Invoice::where('status', InvoiceStatus::Paid)->get()->each(function(Invoice $invoice) {
    echo $invoice->id . ', ' . 
    $invoice->status->toString() . ', ' . 
    $invoice->created_at->format('m/d/Y') . PHP_EOL; 
    
    $invoice->items()->where('description', 'Item 2')->delete();
});  