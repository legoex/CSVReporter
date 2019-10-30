<?php

namespace Activity;

use API\IPStackAdapter;
use API\GeoNamesAdapter;

class CustomerActivity
{
    protected $activity = array();

    public function __construct(array $data)
    {
        $this->activity = $data;
    }

    public function getActivity()
    {
        if ($this->activity) {
            $result = array();
            foreach ($this->activity as $id => $activity) {
                $result[$id] = array(
                    'cntOneContinent' => 0,
                    'cntAll' => 0,
                    'durOneContinent' => 0,
                    'durAll' => 0
                );
                foreach ($activity as $item) {
                    $result[$id]['cntAll']++;
                    $result[$id]['durAll'] += $item['2'];
                    if (IPStackAdapter::getRegion($item['4']) == GeoNamesAdapter::getRegion($item['3'])) {
                        $result[$id]['cntOneContinent']++;
                        $result[$id]['durOneContinent'] = +(int)$item['2'];
                    }
                }
            }

        }
        return $result;
    }


}