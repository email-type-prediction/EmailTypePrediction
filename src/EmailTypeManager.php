<?php

declare(strict_types=1);

namespace EmailTypePrediction\EmailTypePrediction;

use EmailTypePrediction\EmailTypePrediction\Exceptions\InvalidEmailException;
use EmailTypePrediction\EmailTypePrediction\Exceptions\InvalidPathException;
use EmailTypePrediction\EmailTypePrediction\Exceptions\InvalidTypeException;
use EmailTypePrediction\EmailTypePrediction\Services\EmailType;
use EmailTypePrediction\EmailTypePrediction\Services\FilePath;

class EmailTypeManager
{
    /**
     * @param string $email
     *
     * @return bool
     * @throws InvalidEmailException|InvalidTypeException|InvalidPathException
     */
    public function isCommercial(string $email): bool
    {
        foreach (EmailType::values() as $type) {
            if ($this->checkByEmailAndType($email, $type) === true) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $email
     * @return bool
     *
     * @throws InvalidEmailException|InvalidTypeException|InvalidPathException
     */
    public function isEducation(string $email): bool
    {
        return $this->checkByEmailAndType($email, EmailType::DOMAIN_TYPE_EDU_MAIL);
    }

    /**
     * @param string $email
     * @return bool
     *
     * @throws InvalidEmailException|InvalidTypeException|InvalidPathException
     */
    public function isFree(string $email): bool
    {
        return $this->checkByEmailAndType($email, EmailType::DOMAIN_TYPE_FREE_MAIL);
    }

    /**
     * @param string $email
     * @param string $type
     * @return bool
     * @throws InvalidEmailException|InvalidTypeException|InvalidPathException
     */
    private function checkByEmailAndType(string $email, string $type): bool
    {
        $this->validateEmail($email);
        $this->validateType($type);

        $domain = substr(strstr($email, '@'), 1);
        $fileName = (new FilePath())->getFilePath($domain, $type);

        return file_exists($fileName);
    }

    /**
     * @param string $email
     *
     * @throws InvalidEmailException
     */
    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }

    /**
     * @param string $type
     *
     * @throws InvalidTypeException
     */
    private function validateType(string $type): void
    {
        if (EmailType::validate($type) === false) {
            throw new InvalidTypeException();
        }
    }
}
