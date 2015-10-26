<?php
require_once("config.php");

$get = file_get_contents("http://minecraftsmp.altervista.org/mysqlcmd/uptodate.php?version=$version");
$reply = json_decode($get, true);
if(!$get) {
$curl = curl_init();
if(!$curl) {
  die("Couldn't perform your request. You can manually check your if you are up to date on our <a href='https://github.com/J0ker98/MySQLCommands'>GitHub</a>, your version is <b>$version</b>");
}
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://minecraftsmp.altervista.org/mysqlcmd/uptodate.php?version=$version',
    CURLOPT_USERAGENT => 'Update Checker'
));
$reply = curl_exec($curl);
curl_close($curl);
}

if($reply == true) {
echo "Your MySQLCommands installation is the $version and it's up to date!";
} else {
echo "Your MySQLCommands installation is OUTDATED! You are using the $version version. Check for new updates at <a href='https://github.com/J0ker98/MySQLCommands'>GitHub</a>";
}
?>
