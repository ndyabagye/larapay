<?php

namespace App\Enum;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
