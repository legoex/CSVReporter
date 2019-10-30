<?php


namespace Templates;


class TableReportTemplate extends ReportTemplate
{
    public static function print(array $data)
    {
        echo '<h1>TableReportTemplate</h1>';
        foreach ($data as $id => $result) {
            echo "As a result report for Customer ID <strong>$id</strong> we have:<br>";
            echo "Number of customer's calls within same continent: <strong>" . $result['cntOneContinent'] . "</strong>.<br>";
            echo "Total duration of customer's calls within same continent: <strong>" . $result['durOneContinent'] . "</strong> seconds.<br>";
            echo "Number of all customer's calls: <strong>" . $result['cntAll'] . "</strong>.<br>";
            echo "Total duration of all customer's calls: <strong>" . $result['durAll'] . "</strong> seconds.<br>";
            echo "<br><strong>Done!</strong><br>";
        }
    }

}