<?php
/**
 * Created by PhpStorm.
 * User: prg4vit
 * Date: 01.11.2019
 * Time: 09:50
 */

namespace API;


class GeoNamesLocator extends Locator implements IGeoNamesApi
{
    private static $geonames;

    public function getContinent($phoneNumber)
    {
        return $this->getRegionByPhoneNumber($phoneNumber);

    }

    public function getRegionByPhoneNumber($phoneNumber)
    {
        if (self::$geonames) self::$geonames = unserialize(file_get_contents('geonames.txt'));

        $code = substr($phoneNumber, 0, 3);
        return self::$geonames[$code] ?? self::$geonames[$code];
    }
}