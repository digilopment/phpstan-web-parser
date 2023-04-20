<?php
$file = $_GET['path'] ?? '';
$line = $_GET['line'] ?? 0;
exec('gedit +' .$line. ' ' . $file);
