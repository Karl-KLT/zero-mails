<?php

namespace App\constants;

final class MessageTypes
{
    const BLOCK = 0;
    const UNBLOCK = 1;

    public static function getList()
    {
        return [
            MessageTypes::BLOCK => 'block',
            MessageTypes::UNBLOCK => 'unBlock',
        ];
    }

    public static function getOne($id)
    {
        return MessageTypes::getList()[$id];
    }
}
