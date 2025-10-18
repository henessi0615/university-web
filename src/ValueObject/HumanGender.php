<?php

declare(strict_types=1);

namespace App\ValueObject;

enum HumanGender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
}
