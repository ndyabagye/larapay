<?php

namespace App\Enum;

enum PaymentSchedule: string
{
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case BIANNUALLY = 'biannually';
    case ANNUALLY = 'annually';
}
