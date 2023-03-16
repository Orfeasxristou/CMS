<?php
if(isset($_GET['p_id'])){
$user_id=$_GET['p_id'];
$query="SELECT * FROM users WHERE user_id=$user_id ";
$update_user_id=mysqli_query($connection,$query);
confirmQuery($update_user_id);
while($row=mysqli_fetch_assoc($update_user_id)){
$username=$row['username'];
$user_password=$row['user_password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];
$user_role=$row['user_role'];    
                                                } 
                        }
else{
header("Location: index.php");   
    } ?>
    
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="username">Username</label>
<input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
</div>
<div class="form-group">
<label for="title">Password</label>
<input type="password" name="user_password" autocomplete="off"class="form-control">
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
<select name="user_role" id="user_role">
<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
<?php
if($user_role == 'admin'){

echo "<option value='user'>User</option>";
                        } 
else
{

echo "<option value='admin'>Admin </option>";

}
?>
</select>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="edit_user" value="Edit_User">
</div>
</form>
<?php
//UPDATE QUERY
if(isset($_POST['edit_user'])){
$username=$_POST['username'];
$user_password=$_POST['user_password'];
$user_firstname=$_POST['user_firstname'];
$user_lastname=$_POST['user_lastname'];
$user_email=$_POST['user_email'];
$user_role=$_POST['user_role'];    

if(!empty($user_password)){
$query_password="SELECT user_password FROM users WHERE user_id='{$user_id}' ";
$get_user_query=mysqli_query($connection,$query_password);

$row=mysqli_fetch_array($get_user_query);
$db_user_password=$row['user_password'];    

if($db_user_password != $user_password){

$hashed_password= password_hash($user_password, PASSWORD_BCRYPT,array('cost'=>12));


                                        }                       
$query="UPDATE users SET username = '{$username}',user_password ='{$hashed_password}',user_role='{$user_role}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}'  WHERE user_id ='{$user_id}' ";
$update_user_query=mysqli_query($connection,$query);

if(!$update_user_query){

die("Query Failed" . mysqli_error($connection));
                        }
}
}
?>