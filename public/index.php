<?php

use Digilopment\PhpstanWebParser\JsonFileAnalyzer;

require __DIR__ . '/../src/JsonFileAnalyzer.php';

$analyzer = new JsonFileAnalyzer('../data/data.json');
echo $analyzer->analyzeFiles($_GET['path'] ?? '');
