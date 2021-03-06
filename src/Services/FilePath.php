<?php
declare(strict_types=1);

namespace Prediction\EmailType\Services;

use Prediction\EmailType\Exceptions\InvalidPathException;

class FilePath
{
    /**
     * @param string $domain
     * @param string $emailType
     * @return string
     * @throws InvalidPathException
     */
    public function getFilePath(string $domain, string $emailType): string
    {
        $resourcesPath = __DIR__ . '/../../resources/';
        $pathByType = (new Path())->getPathByType($emailType);
        $domainPath = $this->getDomainPath($domain);

        return $resourcesPath . $pathByType . '/' . $domainPath . '.txt';
    }

    /**
     * @param string $domain
     * @return string
     */
    private function getDomainPath(string $domain): string
    {
        $trimString = trim($domain, " \n\r\t\v\0\.");
        $preparedArrayForReverse = explode('.', $trimString);
        $reversedArray = array_reverse($preparedArrayForReverse);

        return implode('/', $reversedArray);
    }
}
