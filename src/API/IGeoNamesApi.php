<?php

namespace API;
interface IGeoNamesApi
{
    public function getRegionByPhoneNumber($code);
}