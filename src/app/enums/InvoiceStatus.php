<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: int
{
    case Pending = 0;
    case Paid = 1;
    case Void = 2;
    case Failed = 3;

    public function toString(): string
    {
        return match ($this) {
             self::Paid=> 'Paid',
             self::Void => 'Void',
             self::Failed => 'Declined',
             default => 'Pending'
        };
    }

    public function color(): Color
    {
        return match ($this) {
             self::Paid=> Color::Green,
             self::Void => Color::Gray,
             self::Failed => Color::Red,
             default => Color::Orange
        };
    }
}