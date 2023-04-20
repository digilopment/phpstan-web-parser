<?php
$file = $_GET['path'] ?? '';
$line = $_GET['line'] ?? 0;
exec('netbeans --open '.$file.':'.$line);
