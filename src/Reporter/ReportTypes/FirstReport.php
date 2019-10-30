<?php


namespace ReportTypes;


use Activity\CustomerActivity;
use API\GeoNamesAdapter;
use API\IPStackAdapter;

class FirstReport extends ReportType
{
    public function report($data)
    {
        $customerIDs = array_unique(array_map(function ($i) {
            return $i[0];
        }, iterator_to_array($data)));
        $customersActivity = array();
        //(O_o)
        foreach ($customerIDs as $customer) {
            foreach ($data as $value) {
                if ($customer == $value[0]) {
                    $customersActivity[$customer][] = $value;
                }
            }
        }

        return $this->getActivity($customersActivity);
    }

    //Some specific method for getting report data
    private function getActivity($customersActivity)
    {
        $result = array();
        foreach ($customersActivity as $id => $activity) {
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
        return $result;
    }
}