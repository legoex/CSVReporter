<?php


namespace ReportTypes;


abstract class ReportType
{
    abstract function report($data);
}