<?php
date_default_timezone_set('Asia/Manila');

$currentTimestamp = time();

echo date('Y-m-d', $currentTimestamp);
echo ' ';
echo date('h:i:s A', $currentTimestamp);
?>