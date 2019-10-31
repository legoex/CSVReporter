<?php

namespace API;
class IPStack implements IApi
{
    private static $APIkey = 'd9f000dbc0237078dfb39bf8033d244c';

    public function getRegion($IP): ?string
    {
        $address = "http://api.ipstack.com/" . $IP . "?access_key=" . self::$APIkey;
        $data = json_decode(file_get_contents($address));
        return $data->continent_code ?? false;
    }

}