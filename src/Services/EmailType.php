<?php

declare(strict_types=1);

namespace EmailTypePrediction\EmailTypePrediction\Services;

class EmailType
{
    public const DOMAIN_TYPE_FREE_MAIL = 'free-mail';
    public const DOMAIN_TYPE_DISPOSABLE_MAIL = 'disposable';
    public const DOMAIN_TYPE_EDU_MAIL = 'edu';
    public const DOMAIN_TYPE_BLOCK_LIST_MAIL = 'block-list';

    public static function values(): array
    {
        return  [
            self::DOMAIN_TYPE_BLOCK_LIST_MAIL,
            self::DOMAIN_TYPE_FREE_MAIL,
            self::DOMAIN_TYPE_DISPOSABLE_MAIL,
            self::DOMAIN_TYPE_EDU_MAIL,
        ];
    }

    public static function validate(string $type): bool
    {
        return in_array($type, self::values(), true);
    }
}
