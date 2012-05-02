<?php
session_start();
if(isset($_GET['msg']) && isset($_SESSION['username']) && $_GET['msg'] != "" && $_SESSION['username'] != ""){
     include 'sql_con.php';
     $sql = "SELECT * FROM pms WHERE `username` = '$_SESSION[username]' AND `id` = '$_GET[msg]'";
     $message = mysql_fetch_assoc(mysql_query($sql));
     if(isset($message['message']) && $message['message'] != ""){
     mysql_query("UPDATE pms SET `read`='true' WHERE `id` = $_GET[msg]");
     ?>
     <div align='center'>
         <h4><?php echo $message['subject'];  ?></h4> <a href='index.php'><< Back To messages</a> | <a href='send.php<?php echo "?sub=Re: ".$message['subject']."&to=".$message['from'];  ?>'>Reply</a><hr /><b><?php echo $message['message'] ?></b>
     </div>
     <?php
     }else{
     header("Location: index.php");
     }
     
}else{
     header("Location: index.php");
}
?>