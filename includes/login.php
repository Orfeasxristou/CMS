<?php
include "../admin/functions.php";
include "db.php"; 
session_start();
?>
<?php
if(isset($_POST['login'])){

login_user($username=$_POST['username'],$password=$_POST['password']);    
}    

?>