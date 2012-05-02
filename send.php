<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != ""){
    if(isset($_GET['send']) && $_GET['send'] != "" && $_GET['send'] == $_GET['m'] * $_GET['u']){
         
         //send
         include 'sql_con.php';
         $to = $_POST['to'];
         $out1 = mysql_query("SELECT * FROM users WHERE `username` = '$to'");
         $cnt = 0;
         while($counter = mysql_fetch_assoc($out1)){
             $cnt += 1;
         }
         if($cnt > 0){
             //Sql Injection Protection
             mysql_select_db($myDB, $dbhandle);
             $i_to = mysql_real_escape_string($_POST['to']);
             $i_sub = mysql_real_escape_string($_POST['sub']);
             $i_from = mysql_real_escape_string($_SESSION['username']);
             $i_m = mysql_real_escape_string($_POST['message']);
             $sql = "INSERT INTO pms (`from`, subject, message, username, `read`) VALUES ('$i_from', '$i_sub', '$i_m', '$i_to', 'false')";
             $sql2 = "INSERT INTO pmo (`from`, subject, message, username, `read`) VALUES ('$i_from', '$i_sub', '$i_m', '$i_to', 'false')";
             if (!mysql_query($sql,$dbhandle) || !mysql_query($sql2,$dbhandle))
                 {
                     header("Location: send.php?e=2");
                  }
                 header("Location: send.php?e=3&u=".$_POST['to']);
         }else{
             header("Location: send.php?e=1&u=".$_POST['to']);
         }
         
    }else{
    
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
     $cur = "<a href='index.php'>Inbox (<b>".$cnt."</b> New)</a> | <a href='sent.php'>Outbox</a> | <a href='logout.php'>Logout</a>";
    }else{
     $cur = "<a href='index.php'>Inbox</a> | <a href='sent.php'>Outbox</a> | <a href='logout.php'>Logout</a>";
    }
    ?>
    <div align='center'>
    <?php $r1 = rand(0, 5000); $r2 = rand(0, 10); $r3 = $r1 * $r2; ?>
    <form action='send.php?send=<?php echo $r3; ?>&m=<?php echo $r1; ?>&u=<?php echo $r2; ?>' method='POST'>
    <h2>Send A Message</h2><?php echo $cur; ?><hr /><?php if(isset($_GET['e']) && ($_GET['e'] == 1 || 2 || 3)){    if($_GET['e'] == 1 && isset($_GET['u']) && $_GET['u'] != ""){ echo "<p style='color:red;'>Error: The user '$_GET[u]' does not exist.</p>";} elseif($_GET['e'] == 2){ echo "<p style='color:red;'>Error: There was an error with the SQL databse. Please contact an administrator.</p>";} elseif($_GET['e'] == 3){echo "<p style='color:green;'>Success! Your message to $_GET[u] was sent!</p>";}    } ?>
    <table><tr><td>From: </td><td><b><?php echo $_SESSION['username']; ?></b></td><tr><td>
     To: </td>
     <td> <input type='textbox' name='to' <?php if(isset($_GET['to'])){ echo "value='$_GET[to]'";} ?>> </td></tr>
     <tr><td>Subject: </td><td><input type='textbox' name='sub' <?php if(isset($_GET['sub'])){ echo "value='$_GET[sub]'";} ?> /></td></tr>
     <tr><td valign='top'>Message: </td><td><textarea rows='4' cols='50' name='message'></textarea></td></tr><tr><td></td><td align='right'><input type='submit' value='Send!'></td></tr></table>
    </form>
    </div>
    <?php
    }
}
?>