<?php


namespace API;


class APIAdapter
{
    protected $firstAPI;

    protected $secondAPI;

    public function __construct(IApi $APIFirst, IApi $APISecond)
    {
        $this->firstAPI = $APIFirst;
        $this->secondAPI = $APISecond;
    }

    public function checkTheSameContinent(string $one, string $two): bool
    {
        return ($this->firstAPI->getRegion($one) == $this->secondAPI->getRegion($two)) ?? true;
    }

}