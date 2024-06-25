<?php

namespace App\Enums;

enum TicketPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';

    public static function toSelectArray(): array
    {
        return [
            self::Low->name => self::Low->value,
            self::Medium->name => self::Medium->value,
            self::High->name => self::High->value,
        ];
    }
}
