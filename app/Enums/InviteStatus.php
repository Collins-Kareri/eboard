<?php

namespace App\Enums;

enum InviteStatus: string
{
    case Pending="pending";
    case Expired="expired";
    case Accepted="accepted";
}
