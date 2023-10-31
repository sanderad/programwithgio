<?php

declare(strict_types = 1);

namespace App\Services;

class InvoiceService
{
    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayServiceInterface $gatewayService,
        protected EmailService $emailService
    ) {
    }

    public function process(array $customer, float $amount): bool
    {
        // 1. Calculate sales tax
        $tax = $this->salesTaxService->calculate($amount, $customer);

        // 2. Process Invoice
        if (! $this->gatewayService->charge($customer, $amount, $tax)) {
            return false;
        };

        // 3. Send Receipt
        $this->emailService->send($customer, 'receipt');

        echo 'Invoice has been processed </br>';

        return true;
    }
}