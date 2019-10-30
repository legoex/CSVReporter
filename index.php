<?php
use Reporter\CSVReporter;
use Templates\SimpleReportTemplate;

if ($_FILES['file']['tmp_name']) {

    include_once 'vendor/autoload.php';
    $file = $_FILES['file']['tmp_name'];
    $report = new CSVReporter($file);
    $report->parse();
    $report->printReport(new SimpleReportTemplate());
    die();
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

