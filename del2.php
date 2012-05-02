<?php
session_start();
if(isset($_GET['msg']) && $_GET['msg'] != "" && isset($_SESSION['username']) && $_SESSION['username'] != ""){
if(isset($_GET['d']) && $_GET['d'] == "1"){
  include 'sql_con.php';
  //do it
  $sql = "SELECT * FROM pmo WHERE `id`='$_GET[msg]'";
$message = mysql_fetch_assoc(mysql_query($sql));
    if($message["from"] == $_SESSION["username"]){
        $sql = "DELETE FROM pmo WHERE `id`='$_GET[msg]'";
        if(mysql_query($sql)){
         header("Location: sent.php");
        }else{
        echo "There was an error processing the SQL Query. Please contact an administrator.";
        }
    }else{
        header("Location: sent.php");
    }
  
}else{
include 'sql_con.php';
$sql = "SELECT * FROM pmo WHERE `id` = '$_GET[msg]'";
$message = mysql_fetch_assoc(mysql_query($sql));
    if($message["username"] == $_SESSION["username"]){
        echo "Are you sure you want to delete <b>$message[subject]</b> from your sent messages?<br><a href='del.php?msg=$_GET[msg]&d=1'>Yes</a> - <a href='index.php'>No</a>";
    }else{
        header("Location: sent.php?1");
    }
}
}else{
     header("Location: sent.php?2");
}



?>