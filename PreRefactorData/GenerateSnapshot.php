<?php

require_once 'vendor/autoload.php';

use App\PreRefactorData\TestScenarioGenerator;

$filePath= __DIR__ . "/snapshot_results.json";

if (file_exists($filePath)) {
    echo "File already exists. Scripts aborts." . PHP_EOL;
    die;
}

$generator = (new TestScenarioGenerator());
$generator->generateSnapshotAndSaveToFile($filePath);

echo "Snapshot saved as : " . $filePath . PHP_EOL;
die;
