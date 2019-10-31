<?php

namespace API;
class GeoNames implements IApi
{
    private static $geonames;

    public function getRegion($phoneNumber): ?string
    {
        if (self::$geonames) self::$geonames = unserialize(file_get_contents('geonames.txt'));

        $code = substr($phoneNumber, 0, 3);
        return self::$geonames[$code] ?? self::$geonames[$code];
    }

}