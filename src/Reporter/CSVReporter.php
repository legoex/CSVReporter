<?php


namespace Reporter;

use Activity\CustomerActivity;
use League\Csv\Reader;
use ReportTypes\ReportType;
use Templates\ReportTemplate;


class CSVReporter extends Reporter
{


    public function parse(ReportType $report)
    {
        $csv = Reader::createFromFileObject($this->file);
        $this->report = $report->report($csv);
    }

    public function printReport(ReportTemplate $template)
    {
        $template->print($this->report);
    }


}