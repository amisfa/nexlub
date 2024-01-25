<?php

namespace App\Enums;

enum TicketCategories: int
{
    case GENERAL = 1;
    case FINANCIAL = 2;
    case REQUEST_GAME = 3;
    case REQUEST_TOURNAMENT = 4;
    case REQUEST_PRIVATE_TABLE = 6;
    case REQUEST_BUG = 7;
    case REPORT_TABLE = 8;
}
