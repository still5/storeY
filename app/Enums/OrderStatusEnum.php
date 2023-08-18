<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case New = 'new';
    case Processing = 'processing';
    case ReadyToShip = 'ready to ship';
    case Shipping = 'shipping';
    case Arrived = 'arrived';
    case Completed = 'completed';
    case Canceled = 'canceled';
    //enum('new', 'processing', 'ready to ship', 'shipping', 'arrived', 'completed', 'canceled')

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
