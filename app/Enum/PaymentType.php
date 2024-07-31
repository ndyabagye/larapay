<?php

namespace App\Enum;

enum PaymentType: string
{
    case VISA = 'visa';
    case CASH = 'card';
    case CHEQUE = 'cheque';
    case AIRTEL_MOBILE_MONEY = 'airtel_mobile_money';
    case MTN_MOBILE_MONEY = 'mtn_mobile_money';

}
