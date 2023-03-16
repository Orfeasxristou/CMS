
<div class="col-md-4">
<!-- Blog Search Well -->
<div class="well">
<h4>Blog Search</h4>
<div class="input-group">
<form action="search.php" method="POST">
<input type="text" name="search" class="form-control">
<span class="input-group-btn">
<button class="btn btn-default" type="submit" name="submit">
<span class="glyphicon glyphicon-search"></span>
</button>
</span>
</form>
</div>
<!-- /.input-group -->
</div>
<!--./well-->
<!--      Login form        -->
<div class="well">
<?php 
if(isset($_SESSION['user_role'])): ?>
<h4>Logged in as <?php echo $_SESSION['username'] ?></h4>
<a href="includes/logout.php" class="btn btn-primary">Log Out</a>
<?php else:  ?>  
<h4>Login</h4>
<form action="includes/login.php" method="POST">
<div class="form group">
<input type="text" name="username" placeholder="Enter Username" class="form-control">
</div>
<div class="form group">
<input type="password" name="password" placeholder="Enter Password" class="form-control">
</div>
<br>
<div class="form group">
<button class="btn btn-primary" type="submit" name="login" value="Login">Login
</button>
</div>
</form>   
<?php endif;  ?>     
</div>
<!--./well-->

<!-- Blog Categories Well -->
<div class="well">
<?php
//SELECT CATEGORIES QUERY
$query="SELECT * FROM categories";
$select_categories_sidebar=mysqli_query($connection,$query);
?>
<!--SHOW CATEGORIES-->
<h4>Blog Categories</h4>
<div class="row">
<div class="col-lg-12">
<ul class="list-unstyled">
<?php                                                      
while($row=mysqli_fetch_assoc($select_categories_sidebar)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];
echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
}
?>
</ul>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!--./container-->

<!-- Side Widget Well -->
<?php
include 'widget.php';
?>
</div>

