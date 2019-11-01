<?php
/**
 * Created by PhpStorm.
 * User: prg4vit
 * Date: 01.11.2019
 * Time: 09:48
 */

namespace API;


class IPStackLocator extends Locator implements IIPStackApi
{
    private static $APIkey = 'd9f000dbc0237078dfb39bf8033d244c';

    public function getContinent($val)
    {
        return $this->getRegionByIp($val);
    }

    public function getRegionByIp($IP)
    {
        $address = "http://api.ipstack.com/" . $IP . "?access_key=" . self::$APIkey;
        $data = json_decode(file_get_contents($address));
        return $data->continent_code ?? false;
    }
}