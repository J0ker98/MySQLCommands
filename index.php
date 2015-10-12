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
require 'config.php';

function MySQLCommandsError($errno, $errstr) {
  $errormsg = '<div class="alert alert-danger" role="alert"><strong>Error!</strong> [$errno] $errstr</div>';
  echo htmlspecialchars($errormsg);
}

set_error_handler("MySQLCommandsError");

  if(!empty($_POST['command'])) 
  {
$db_connection = new mysqli($dbhost, $dbname, $dbpass, $dbname);
      
  if($db_connection->connect_errno > 0){
die('Unable to connect to database [' . $db->connect_error . ']');
}
      
$command = $_POST['command']; 
$command_count = strlen($command);
  if($command_count > "255") {
die("Your Message contains too many characters. Maximum is 255 and you used $command_count of them.");
} 
// No fancy solution but does what it has to do
$remove_quotation = str_replace('"', "", $command);
$finished_result = str_replace("'", "", $remove_quotation);
                          
                          
$sqlqry = 'INSERT INTO `MySQLCommands` (`command`) VALUES('.$finished_result.')';
      
if(!$result = $db->query($sqlqry)){
    die('There was an error running the insert in the database [' . $db->error . ']');
}
    echo "Command '$finished_result' successfully sheduled.";
    } else {
        trigger_error("Command not defined.", E_USER_ERROR);
    } 
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MySQL Commands &bull; Web UI</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<form method='post' action='<?php echo __FILE__; ?>' class="form-horizontal">
<fieldset>
<legend>MySQL Commands Console</legend>
<div class="form-group">
  <label class="col-md-4 control-label" for="command"></label>  
  <div class="col-md-6">
  <p>Execute Command, ' and " will be removed.</p><br />
  <input type="text" id="command" name="command" maxlength="255" placeholder="Command" class="form-control input-md">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">
    <button type='submit' class="btn btn-success">Submit !</button>
  </div>
</div>

</fieldset>
</form>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
