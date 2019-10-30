<?php


namespace Reporter;

use Activity\CustomerActivity;
use League\Csv\Reader;
use Templates\ReportTemplate;

class CSVReporter extends Reporter
{


    public function parse()
    {
        $csv = Reader::createFromFileObject($this->file);
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
        $activity = new CustomerActivity($customersActivity);
        $this->report = $activity->getActivity();
    }

    public function printReport(ReportTemplate $template)
    {
        $template->print($this->report);
    }


}