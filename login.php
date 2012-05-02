<?php
//login
session_start();



if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST["password"] != ""){

     if($_POST['username'] == "poop"){
         if($_POST["password"] == "iampoop"){
             $_SESSION['username'] = "poop";
             header("Location: index.php");
         }
     }elseif($_POST['username'] == "thefiscster510"){
         if($_POST["password"] == "nathan51095n"){
             $_SESSION['username'] = "thefiscster510";
             header("Location: index.php");
         }
     }

}else{
?>
<div align='center'>
<form action='login.php' method='POST'>
     <table>
         <tr>
             <td>
                Username:
             </td>
             <td>
                <input type='text' name='username' />
             </td>
         </tr>
         <tr>
             <td>
                Password:
             </td>
             <td>
                <input type='password' name='password' />
             </td>
         </tr>
         <tr>
             <td>
                
             </td>
             <td align='right'>
                <input type='submit' value='Login' />
             </td>
         </tr>
     </table>
</form>
</div>
<?php
}





?>