<?php

namespace App\Enums;

enum CashOutStatuses: int
{
    case Waiting = 1;
    case Paid = 2;
    case Canceled = 3;
    case Rejected = 4;
}
