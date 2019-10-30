<?php

namespace Reporter;

use SplFileObject;
use Templates\IReportTemplate;
use Templates\ReportTemplate;

abstract class Reporter
{
    protected $file;

    protected $report;

    public function __construct(string $file)
    {
        $file = new SplFileObject($file);
        if ($file instanceof SplFileObject) {
            $this->file = $file;
        } else {
            die("No file given.");
        }
    }

    abstract public function parse();

    abstract public function printReport(ReportTemplate $template);

}