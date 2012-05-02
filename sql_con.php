<?php

//Define
$myServer = "";
$myDB = "pm_system"; //Anything you want. It will be automatically created.
$myUser = "";
$myPass = "";



$dbhandle = mysql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer"); 
  
mysql_query("CREATE DATABASE IF NOT EXISTS $myDB");

$selected = mysql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB"); 

mysql_query("CREATE TABLE IF NOT EXISTS `pms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(800) NOT NULL,
  `username` varchar(255) NOT NULL,
  `read` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

mysql_query("CREATE TABLE IF NOT EXISTS `pmo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(800) NOT NULL,
  `username` varchar(255) NOT NULL,
  `read` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

mysql_query("CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
)");

$users = mysql_fetch_assoc(mysql_query("SELECT * FROM `users`"));
if(isset($users["username"]) && $users["username"] != ""){}else{
mysql_query("INSERT INTO `users` (username, password) VALUES ('thefiscster510', 'iamnathan')");
mysql_query("INSERT INTO `users` (username, password) VALUES ('poop', 'iampoop')");
}

?>