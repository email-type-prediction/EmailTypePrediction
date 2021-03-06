<?php
declare(strict_types=1);

namespace EmailTypePrediction\EmailTypePrediction\Services;

use EmailTypePrediction\EmailTypePrediction\Exceptions\InvalidPathException;

class Path
{
    private const PATH_FREE_MAIL = 'free';
    private const PATH_BLOCK_LIST = 'block-list';
    private const PATH_DISPOSABLE = 'disposable';
    private const PATH_EDUCATION = 'edu';

    public static function values(): array
    {
        return  [
            self::PATH_BLOCK_LIST,
            self::PATH_FREE_MAIL,
            self::PATH_EDUCATION,
            self::PATH_DISPOSABLE
        ];
    }

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
        $this->validate($path);

        return $path;
    }

    /**
     * @param string|null $path
     *
     * @throws InvalidPathException
     */
    private function validate(?string $path): void
    {
        if (is_null($path) || in_array($path, self::values(), true) === false) {
            throw new InvalidPathException();
        }
    }
}
