<?php

declare (strict_types = 1);

namespace Tests\Unit\Services;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    /** @test */
    public function it_processes_invoice(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        $gatewayServiceMock->method('charge')->willReturn(true);

        // given the object of the invoice service
        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $gatewayServiceMock, 
            $emailServiceMock
        );

        $customer = ['name' => 'Alx'];
        $amount = 150;
        // when process method is called
        $result = $invoiceService->process($customer, $amount);

        // then assert invoice is processed successfully
        $this->assertTrue($result);
    }

    /** @test */
    public function it_sends_enail_receipt_when_invoice_is_processed(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        $gatewayServiceMock->method('charge')->willReturn(true);

        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->with(['name' => 'Alx'], 'receipt'
        );

        // given the object of the invoice service
        $invoiceService = new InvoiceService(
            $salesTaxServiceMock, 
            $gatewayServiceMock, 
            $emailServiceMock
        );

        $customer = ['name' => 'Alx'];
        $amount = 150;
        // when process method is called
        $result = $invoiceService->process($customer, $amount);

        // then assert invoice is processed successfully
        $this->assertTrue($result);
    }
}