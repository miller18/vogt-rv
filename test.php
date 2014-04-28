<?php

echo time();

//echo (date('d-M-Y', strtotime('2013-11-30 00:00:00')));

//echo date_diff(date_create(date('d-M-Y', '2013-11-30 00:00:00')), date_create(date('d-M-Y', time())));

date_diff(strtotime('2013-11-21 00:00:00'), strtotime('2013-11-30 00:00:00'));
?>