<?php
/*
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
*/
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MySQL Commands &bull; Web UI</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/darkly/bootstrap.min.css">
</head>
<body>
<style>body {overflow: hidden;}</style>
<form method='post' action='./execute.php' class="form-horizontal">
<fieldset>
<h1><center><legend><font size="6">MySQL Commands Console</font></legend></center></h1>
<?php if(!isset($_GET['schedule'])) { ?>
<div class="form-group">
  <label class="col-md-3 control-label" for="command"></label>
  <div class="col-md-6">
    <?php if(isset($_GET['success']) or isset($_GET['error'])) { ?>
    <div class="alert alert-<?php if(isset($_GET['success'])){echo"success";}else{echo "danger";}?>" role="alert"><strong>
    <?php if(isset($_GET['success'])){echo"Success";}else{echo"Error";}?>!</strong> <?php if(isset($_GET['success'])){echo$_GET['success'];}else{echo$_GET['error'];}?></div>
    <br>
    <?php } ?>
  <center><p>Send your command to the Minecraft Server. Characters <b>'</b> and <b>"</b> will be removed.</p></center><br />
  <input type="text" id="command" name="command" maxlength="255" placeholder="Command" class="form-control input-md">
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label"></label>
  <div class="col-md-4">
    <button type='submit' class="btn btn-success" style="margin-right: 0.115em; margin-left: 0.115em;">Submit</button> <a class="btn btn-info" style="margin-right: 0.115em; margin-left: 0.115em;" href='./index.php?schedule'>Scheduled Commands</a> <a class="btn btn-primary" style="margin-right: 0.115em; margin-left: 0.115em;" href='./update.php'>Check for Updates</a>
  </div>
</div>
<?php  } else {
require_once("./config.php");
      $con = mysqli_connect($dbhost, $dbname, $dbpass, $dbname);

      if($con->connect_error) {
		die("Couldn't connect to database. Error:".$conn->connect_error);
      }

$select = 'SELECT * FROM `MySQLCommands` ORDER BY `id` ASC';
$rs=$con->query($select);

$count = $rs->num_rows;
if($count >= 1) {
echo "<div class='col-md-3'></div><div class='col-md-6'><table class='table table-bordered'>";
echo "<tr><td>#</td><td>Command</td><td>Action</td></tr>";
while($row = mysqli_fetch_array($rs)) {
echo "<tr><td>".$row['id']."</td><td>".$row['command']."</td><td><a class='btn btn-danger' href='./execute.php?delete=".$row['id']."' onclick='Conf()'><span class='glyphicon glyphicon-remove'></span></td></tr>";
}
echo "</table>";

  ?>

  <script>
  function Conf() {
      confirm("Are you sure?");
  }
  </script>
  <div class="col-md-4">
    <a class="btn btn-info" href='./index.php'>Send Commands</a>
  </div>
  <br><br><br>
  <p>These will be executed, from the top to the bottom, by the Server. <br>Check you MySQLCommands Plugin config.yml file to alter the execution interval.</p>
</div>
<?php } else {
        ?>
        <br><br>
        <label class="col-md-3 control-label" ></label>
        <div class="col-md-6">
          <center><p>No commands in the schedule.</p><br><br>
          <a class="btn btn-info" href='./index.php'>Send Commands</a>
        </center>
        </div>
        <?php
    }
} ?>
</fieldset>
</form>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>

