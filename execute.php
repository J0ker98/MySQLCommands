<?php
/**
    MySQLCommans Web Prompt
    Copyright (C) 2015 Stefano Zeppieri - http://stefanozeppieri.altervista.org

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>. 
**/

$dbhost = 'localhost'; //Your DB Hostname.
$dbuser = 'root'; //Your DB Username.
$dbpass = '12345'; //Your DB Password.
$dbname = 'minecraft'; //Your DB Name.

  if(!empty($_GET['command'])) {
      
      $con = mysql_connect($dbhost,$dbname,$dbpass);
      mysql_select_db($dbname);
      
                             $command = $_GET['command'];
                             
                              $command_count = strlen($command);
                        if($command_count > "255") {
                          die("Your Message contains too many characters. Maximum is 255 and you used $command_count of them.");
                          } 
                          $check1 = strpos($command, '"');
                          $check2 = strpos($command, "'");
                          
                          if($check1 !== false or $check2 !== false) {
                               die("Your Message contains not allowed characters.");
                               }
                          
    $insert = mysql_query("INSERT INTO `MySQLCommands` (`command`) VALUES('$command')") or die("MYSQL INSERT COMMAND QUERY ERROR: " . mysql_error());
    echo "Command '$command' successfully sheduled.";
    } else {
        echo "Command '$command' not defined.";
    } 
?>
