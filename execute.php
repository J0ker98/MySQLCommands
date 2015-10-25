
<?php
function MessageHandler($message,$type) {
  //TYPE: 0 = ERROR, 1 = SUCCESS
  if(!$message) {
    die("No message set!");
  }
if($debug != 'true') {
    if($type == 0) {
      header("Location: ./index.php?error=$message");
      exit();
    } elseif($type == 1) {
      header("Location: ./index.php?success=$message");
      exit();
    } else {
      die("Unknown message type set! Use 0 for errors and 1 for success messages.");
    }
  } else {
    echo "Error: $error";
    echo "<br><br>";
    echo "Success: $success";
  }
}

  if(!empty($_POST['command'])) {
require_once("./config.php");

      $con = mysql_connect($dbhost,$dbname,$dbpass);

      if(!$con) {
        $error = "Couldn't connect to database.";
        MessageHandler($error,0);
      }
      mysql_select_db($dbname) or die("Cannot select defined database. Error:".mysql_error());

                             $command = $_POST['command'];

                             $command_count = strlen($command);
                        if($command_count > "255") {
                          $error = "Your Message contains too many characters. Maximum is 255 and you used $command_count of them.";
                          MessageHandler($error,0);
                          }
                          $check1 = strpos($command, '"');
                          $check2 = strpos($command, "'");

                          if($check1 !== false or $check2 !== false) {
                               $error = "Your Message contains not allowed characters.";
                               MessageHandler($error,0);
                               }

    $insert = mysql_query("INSERT INTO `MySQLCommands` (`command`) VALUES('$command')") or die("MYSQL INSERT COMMAND QUERY ERROR: " . mysql_error());
    $success = "Command '$command' successfully scheduled.";
    MessageHandler($success,1);
  } elseif(!empty($_GET['delete'])) {
    require_once("./config.php");

          $con = mysql_connect($dbhost,$dbname,$dbpass);

          if(!$con) {
            $error = "Couldn't connect to database.";
            MessageHandler($error,0);
          }
          mysql_select_db($dbname) or die("Cannot select defined database. Error:".mysql_error());

      $id = $_GET['delete'];

      $delete = mysql_query("DELETE FROM `MySQLCommands` WHERE `id` = '$id'");
      if(!$delete) {
        $error = "There was an error while performing the request.";
        MessageHandler($error,0);
      } else {
        $success = "Command deleted.";
        MessageHandler($success,1);
      }
    } else {
        $error = "Command not defined.";
        MessageHandler($error,0);
    }
?>
