<?php


namespace Templates;


abstract class ReportTemplate
{
    abstract public static function print(array $data);
}