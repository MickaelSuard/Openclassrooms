<?php

namespace App\Enum;

enum BookStatus: string
{
    case Available = 'Disponible';
    case Borrowed = 'Emprunté';
    case Unavailable = 'Indisponible';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::Available => 'Disponible',
            self::Borrowed => 'Emprunté',
            self::Unavailable => 'Indisponible',
        };
        // return $this->value;
    }
}