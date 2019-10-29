<?php

namespace CSVReporter;

use League\Csv\Reader;
use SplFileObject;

class CSVReporter
{

    protected $file;
    private $geonames;

    public function __construct($file)
    {
        $file = new SplFileObject($file);
        if ($file instanceof SplFileObject) {
            $this->file = $file;
        }
    }

    public function makeReport()
    {
        if ($this->file) {

            $activity = $this->parseCustomerActivity($this->file);
            $result = $this->parseActivity($activity);
            if ($result) echo 'End';
        }
    }

    private function parseCustomerActivity(SplFileObject $file)
    {
        $csv = Reader::createFromFileObject($file);
        $customerIDs = array_unique(array_map(function ($i) {
            return $i[0];
        }, iterator_to_array($csv)));
        $customersActivity = array();
        //(O_o)
        foreach ($customerIDs as $customer) {
            foreach ($csv as $value) {
                if ($customer == $value[0]) {
                    $customersActivity[$customer][] = $value;
                }
            }
        }
        return $customersActivity;
    }

    private function parseActivity($data)
    {
        foreach ($data as $id => $activity) {
            echo "As a result report for Customer ID <strong>$id</strong> we have:<br>";
            $cntOneContinent = 0;
            $durOneContinent = 0;
            $cntAll = 0;
            $durAll = 0;
            foreach ($activity as $item) {
                $cntAll++;
                $durAll += $item['2'];
                if ($this->checkSameContinent($item['4'], $item['3'])) {
                    $cntOneContinent++;
                    $durOneContinent += (int)$item['2'];
                }
            }
            echo "Number of customer's calls within same continent: <strong>$cntOneContinent</strong>.<br>";
            echo "Total duration of customer's calls within same continent: <strong>$durOneContinent</strong> seconds.<br>";
            echo "Number of all customer's calls: <strong>$cntAll</strong>.<br>";
            echo "Total duration of all customer's calls: <strong>$durAll</strong> seconds.<br>";
            echo "<br><strong>Done!</strong><br>";
        }
        return true;
    }

    private function checkSameContinent($ip, $phone)
    {
        $ipCode = $this->getContinentByIP($ip);
        $phoneCode = $this->getContinentByPhoneCode($phone);
        return ($ipCode == $phoneCode) ?? true;
    }

    //Return Ex 'EU' for IP 37.35.105.218
    private function getContinentByIP($IP)
    {
        $APIKey = 'd9f000dbc0237078dfb39bf8033d244c';
        $content = json_decode(file_get_contents("http://api.ipstack.com/$IP?access_key=$APIKey"));
        return $content->continent_code ?? false;
    }


    //Return Ex 'AS' for "Phone" => "995"
    private function getContinentByPhoneCode($number)
    {
        //Performance improve
        if (!$this->geonames) $this->geonames = unserialize(file_get_contents('geonames.txt'));

        $code = substr($number, 0, 3);
        return $this->geonames[$code] ?? $this->geonames[$code];
    }
}