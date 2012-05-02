<?php session_start();
echo "<title>PM System</title>";
if(isset($_SESSION['username']) && $_SESSION['username'] != ""){ ?>
<div align='center'><h2>Personal Messages</h2><a href='send.php'>Send New Message</a> | <a href='sent.php'>Outbox</a> | <a href='logout.php'>Logout</a></div><hr />
<?php
include 'sql_con.php';

//Get your current PMs
echo "<div align='center'>";

$user = $_SESSION['username'];
$query = "SELECT * FROM pms WHERE `username` = '$user'";
$getd = mysql_query($query);
$getd2 = mysql_query($query);

$cnt = 0;
while($row = mysql_fetch_assoc($getd2)){
$cnt += 1;
}

if($cnt != 0){
echo  "<table style='width:100%;'><tr><td><b>From</b></td><td></td><td style='width:100%;'><b>Subject</b></td><td></td><td></td><td></td></tr>";
$str = "";
while($row = mysql_fetch_assoc($getd)){
    
     if($row["read"] == "false"){
         $b1 = "<b>";
         $b2 = "</b>";
     }else{
         $b1 = "";
         $b2 = "";
     }

     $str ="<tr style='border:1;'><td style='border:1;'>".$b1.$row['from'].$b2."</td><td><b>&nbsp;&nbsp;&nbsp;$b1|$b2&nbsp;&nbsp;&nbsp;</b></td><td style='width:300;border:1;'>".$b1.$row['subject'].$b2."</td><td style='border:1;'><a href='read.php?msg=".$row['id']."'>".$b1."Read".$b2."</a></td><td><a href='send.php?sub=Re: $row[subject]&to=$row[from]'>".$b1."Reply".$b2."</a></td><td><a href='del.php?msg=".$row['id']."&d=1'>".$b1."Delete".$b2."</a></td></tr>".$b2.$str;
}
echo $str;
echo "</table>";
}else{
 echo "You have no messages at this time. Please come again.";
}



echo "</div>";

}else{
echo "<div align='center'>You must be logged in to view this information.<br />Click <a href='login.php'>Here</a> to login<hr width='200' /></div>";
}
?>