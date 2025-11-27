<?php
namespace App\Exception;
use Exception;

class SiakadException extends Exception
{
    public static function failedToCollectCookies()
    {
        return new self('Failed to collect SIAKAD cookies');
    }

    public static function failedToCollectBiodata()
    {
        return new self('Failed to collect student biodata from SIAKAD');
    }
}