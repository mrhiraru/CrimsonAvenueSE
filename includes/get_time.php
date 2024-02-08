<?php
date_default_timezone_set('Asia/Manila');

$currentTimestamp = time();

echo date('Y-m-d', $currentTimestamp).' '.date('h:i:s A', $currentTimestamp);
?>