<?php session_start();
echo "<title>PM System</title>";
if(isset($_SESSION['username']) && $_SESSION['username'] != ""){ 
include 'sql_con.php';

$user = $_SESSION['username'];
    $sql = "SELECT * FROM pms WHERE `username` = '$user' AND `read` = 'false'";
    $getd2 = mysql_query($sql);
    $cnt = 0;
    if(mysql_fetch_assoc($getd2)){
    $cnt += 1;
    while($row = mysql_fetch_assoc($getd2)){
         $cnt += 1;
    }
    }
   
    if($cnt > 0){
     $cur = "<a href='index.php'>Inbox (<b>".$cnt."</b> New)</a>";
    }else{
     $cur = "<a href='index.php'>Inbox</a>";
    }
?>
<div align='center'><h2>Sent Messages</h2><a href='send.php'>Send New Message</a> | <?php echo $cur; ?>  | <a href='logout.php'>Logout</a></div><hr />
<?php
//Get your current pmo
echo "<div align='center'>";

$user = $_SESSION['username'];
$query = "SELECT * FROM pmo WHERE `from` = '$user'";
$getd = mysql_query($query);
$getd2 = mysql_query($query);

$cnt = 0;
while($row = mysql_fetch_assoc($getd2)){
$cnt += 1;
}

if($cnt != 0){
echo  "<table style='width:100%;'><tr><td><b>To</b></td><td></td><td style='width:100%;'><b>Subject</b></td><td></td><td></td></tr>";
$str = "";
while($row = mysql_fetch_assoc($getd)){
    
     if($row["read"] == "false"){
         $b1 = "<b>";
         $b2 = "</b>";
     }else{
         $b1 = "";
         $b2 = "";
     }

     $str ="<tr style='border:1;'><td style='border:1;'>".$b1.$row['username'].$b2."</td><td><b>&nbsp;&nbsp;&nbsp;$b1|$b2&nbsp;&nbsp;&nbsp;</b></td><td style='width:300;border:1;'>".$b1.$row['subject'].$b2."</td><td style='border:1;'><a href='read2.php?msg=".$row['id']."'>".$b1."View".$b2."</a></td><td><a href='del2.php?msg=".$row['id']."&d=1'>".$b1."Delete".$b2."</a></td></tr>".$b2.$str;
}
echo $str;
echo "</table>";
}else{
 echo "You have no messages in your sent folder.";
}



echo "</div>";

}else{
header("Location: index.php");
}
?>