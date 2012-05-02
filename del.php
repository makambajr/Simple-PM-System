<?php
session_start();
if(isset($_GET['msg']) && $_GET['msg'] != "" && isset($_SESSION['username']) && $_SESSION['username'] != ""){
if(isset($_GET['d']) && $_GET['d'] == "1"){
  include 'sql_con.php';
  //do it
  $sql = "SELECT * FROM pms WHERE `id`='$_GET[msg]'";
$message = mysql_fetch_assoc(mysql_query($sql));
    if($message["username"] == $_SESSION["username"]){
        $sql = "DELETE FROM pms WHERE `id`='$_GET[msg]'";
        if(mysql_query($sql)){
         header("Location: index.php");
        }else{
        echo "There was an error processing the SQL Query. Please contact an administrator.";
        }
    }else{
        header("Location: index.php");
    }
  
}else{
include 'sql_con.php';
$sql = "SELECT * FROM pms WHERE `id` = '$_GET[msg]'";
$message = mysql_fetch_assoc(mysql_query($sql));
    if($message["username"] == $_SESSION["username"]){
        echo "Are you sure you want to delete <b>$message[subject]</b> from your inbox?<br><a href='del.php?msg=$_GET[msg]&d=1'>Yes</a> - <a href='index.php'>No</a>";
    }else{
        header("Location: index.php?1");
    }
}
}else{
     header("Location: index.php?2");
}



?>