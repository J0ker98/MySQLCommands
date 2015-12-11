<?php
/*
This is the Configuration File. Please insert your data here
*/
$dbhost = 'localhost'; //Your DB Hostname.
$dbuser = 'root'; //Your DB Username.
$dbpass = '12345'; //Your DB Password.
$dbname = 'minecraft'; //Your DB Name.

$debug = 'false'; //Debug mode, set to 'true' to activate.
$updatechecking = 'true'; //Should the Script search for Updates automatically
/*
Do not edit down here if you don't know what you are doing!
*/
if($debug != 'true') {
error_reporting(0);
}
/*
Update Variables | DO NOT EDIT THESE OR YOU WOULD NOT BE ABLE TO CHECK FOR UPDATES!
*/
$version = "A_0.1.2";
