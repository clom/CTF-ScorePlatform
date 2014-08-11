<?php
//database conf
// Configration
mb_language("uni");
mb_internal_encoding("utf-8");
mb_http_input("auto");
mb_http_output("utf-8");

//DatabaseServer
$db_url = "DB_URL";
$db_user = "DB_USER";
$db_pass = "DB_PASS";

//DatabaseUSE
$db_use = "DB";

// start challenge
$s_sec = "SEC";
$s_min = "MIN";
$s_hour ="HOUR";
$s_year = "YEAR";
$s_month = "MONTH";
$s_day = "DAY";

//end challenge
$sec = "SEC";
$min = "MIN";
$hour ="HOUR";
$year = "YEAR";
$month = "MONTH";
$day = "DAY";

//timestamp Do not Edit it.
$timestamp = mktime($hour,$min,$sec,$month,$day,$year);
$s_timestamp = mktime($s_hour,$s_min,$s_sec,$s_month,$s_day,$s_year);

$secret = "Admin Password";
?>
