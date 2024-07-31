<?php

namespace App\Enum;

enum ApplicationStatus: string
{
    case SUBMITTED = 'submitted';
    case ACCEPTED = 'accepted';
    case REVIEW = 'review';
    case REJECTED = 'rejected';
}
