<?php 
insert_users();
?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Username</label>
<input type="text" name="username" class="form-control">
</div>
<div class="form-group">
<label for="title">Password</label>
<input type="password" name="user_password" class="form-control">
</div>
<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" name="user_firstname" class="form-control">
</div>
<div class="form-group">
<label for="user_lastname">Lastname</label>
<input type="text" name="user_lastname" class="form-control">
</div>
<div class="form-group">
<label for="user_email">Email</label>
<input type="text" name="user_email" class="form-control">
</div>
<div class="form-group">
<select name="user_role" id="user_role">
<option value="Choose Role">Choose Role</option>
<option value="Admin">Admin</option>
<option value="User">User</option>
</select>
</div>
<!--BUTTON CLASS-->
<div class="form-group">
<input type="submit" class="btn btn-primary" name="add_user" value="Add_User">
</div>
</form>