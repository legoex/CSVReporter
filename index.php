<?php
use ReportTypes\FirstReport;
use Reporter\CSVReporter;


if ($_FILES['file']['tmp_name']) {

    include_once 'vendor/autoload.php';
    $file = $_FILES['file']['tmp_name'];
    $report = new CSVReporter($file);
    $report->parse(new FirstReport());
    $report->printReport(new \Templates\SimpleReportTemplate());
    $report->printReport(new \Templates\TableReportTemplate());
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP File Upload</title>
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">
    <div>
        <span>Upload a File:</span>
        <input type="file" name="file"/>
    </div>

    <input type="submit" name="uploadBtn" value="Upload"/>
</form>
</body>
</html>

