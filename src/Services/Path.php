<?php

declare(strict_types=1);

namespace Prediction\EmailType\Services;

use Prediction\EmailType\Exceptions\InvalidPathException;

class Path
{
    private const PATH_FREE_MAIL = 'free';
    private const PATH_BLOCK_LIST = 'block-list';
    private const PATH_DISPOSABLE = 'disposable';
    private const PATH_EDUCATION = 'edu';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return  [
            self::PATH_BLOCK_LIST,
            self::PATH_FREE_MAIL,
            self::PATH_EDUCATION,
            self::PATH_DISPOSABLE
        ];
    }

    /**
     * @return string[]
     */
    public static function mapperPathToEmailType(): array
    {
        return [
            self::PATH_BLOCK_LIST => EmailType::DOMAIN_TYPE_BLOCK_LIST_MAIL,
            self::PATH_FREE_MAIL => EmailType::DOMAIN_TYPE_FREE_MAIL,
            self::PATH_DISPOSABLE => EmailType::DOMAIN_TYPE_DISPOSABLE_MAIL,
            self::PATH_EDUCATION => EmailType::DOMAIN_TYPE_EDU_MAIL
        ];
    }

    /**
     * @param string $type
     * @return string
     *
     * @throws InvalidPathException
     */
    public function getPathByType(string $type): string
    {
        $path = array_search($type, self::mapperPathToEmailType(), true);

        if (is_string($path) === false || in_array($path, self::values(), true) === false) {
            throw new InvalidPathException();
        }

        return $path;
    }
}
