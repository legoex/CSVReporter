<?php

namespace API;
class GeoNames implements IGeoNamesApi
{
    private static $geonames;

    public function getRegionByPhoneNumber($phoneNumber): ?string
    {
        if (self::$geonames) self::$geonames = unserialize(file_get_contents('geonames.txt'));

        $code = substr($phoneNumber, 0, 3);
        return self::$geonames[$code] ?? self::$geonames[$code];
    }

}