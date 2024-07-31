<?php

namespace App\Enum;

enum MaintenanceRequestStatus: string
{
    case SUBMITTED = 'submitted';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case REJECTED = 'rejected';

}
