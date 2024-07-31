<?php

namespace App\Enum;

enum RoleName: string
{
    case ADMIN = 'admin';
    case TENANT = 'tenant';
    case CONTRACTOR = 'contractor';
    case PROPERTY_MANAGER = 'property_manager';
    case LANDLORD = 'landlord';
}
