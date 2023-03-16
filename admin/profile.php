<?php
include 'includes/admin_header.php';
?>
<?php
//SELECR USERS QUERY
if(isset($_SESSION['username'])){

$username=$_SESSION['username'];
$query="SELECT * FROM users WHERE username='{$username}' ";
$select_profile_query=mysqli_query($connection,$query);
if(!$select_profile_query){
die("Query Failed".mysqli_error($connection));
                            }
while($row=mysqli_fetch_assoc($select_profile_query)){
$username=$row['username'];
//        $user_password=$row['user_password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];


                                                    }
                                    }
?>
<div id="wrapper">
<!--UPDATE PROFILE-->
<?php
if(isset($_POST['update_profile'])){
$user_name=$_POST['username'];
$user_password=$_POST['user_password'];
$user_firstname=$_POST['user_firstname'];
$user_lastname=$_POST['user_lastname'];
$user_email=$_POST['user_email'];
$query="UPDATE users SET username='{$user_name}',user_password ='{$user_password}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}' WHERE username ='{$username}' ";
$update_profile_query=mysqli_query($connection,$query);
if(!$update_profile_query){

die("Query Failed" . mysqli_error($connection));
                            }
                                    }
?>

<?php
include 'includes/admin_navigation.php';
?>
<!--Page wrapper-->
<div id="page-wrapper">
<!--Container-Fluid-->
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
Welcome Admin
<small><?php echo $_SESSION['username']; ?></small>
</h1>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="username">Username</label>
<input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
</div>
<div class="form-group">
<label for="title">Password</label>
<input type="password" autocomple="off" name="user_password"  class="form-control">
</div>
<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" name="user_firstname" value="<?php echo $user_firstname; ?>" class="form-control">
</div>
<div class="form-group">
<label for="user_lastname">Lastname</label>
<input type="text" name="user_lastname" value="<?php echo $user_lastname; ?>" class="form-control">
</div>
<div class="form-group">
<label for="user_email">Email</label>
<input type="text" name="user_email" value="<?php echo $user_email; ?>" class="form-control">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="update_profile" value="Update_Profile">
</div>
</form>
<div class="col-xs-12"></div>
</div>
<!--/.col-lg-12-->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->

<?php
include 'includes/admin_footer.php';
?>
