<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Open = 'open';
    case InProgress = 'in_progress';
    case Closed = 'closed';

    public static function toSelectArray(): array
    {
        return [
            self::Open->name => self::Open->value,
            self::InProgress->name => self::InProgress->value,
            self::Closed->name => self::Closed->value,
        ];
    }
}
