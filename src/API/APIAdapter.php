<?php


namespace API;


class APIAdapter
{
    protected $firstAPI;

    protected $secondAPI;

    public function __construct(IGeoNamesApi $APIFirst, IIPStackApi $APISecond)
    {
        $this->firstAPI = $APIFirst;
        $this->secondAPI = $APISecond;
    }

    public function checkTheSameContinent(string $one, string $two): bool
    {
        return ($this->firstAPI->getRegionByPhoneNumber($one) == $this->secondAPI->getRegionByIp($two)) ?? true;
    }

}