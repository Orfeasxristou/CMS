<?php
include 'db.php';
session_start();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="index.php">Home</a>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<?php
//SELECT CATEGORIES QUERY
$query="SELECT * FROM categories";
$select_all_categories=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_all_categories)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];
$category_class="";
$registration_class="";
$page_name=basename($_SERVER['PHP_SELF']); 
$registration='registration.php';   

if(isset($_GET['category']) && $_GET['category']==$cat_id ){

$category_class='active';

}                                                                            
    elseif($page_name == $registration){

$registration_class='active';
                                        }   


echo "<li class='$category_class'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";

                                                        }

?>
<li><a href="admin">Admin</a></li>

<?php
//Edit Posts link
if(isset($_SESSION['user_role'])){
if(isset($_GET['p_id'])){
$the_post_id=$_GET['p_id'];
echo "<li><a href='admin/posts.php?source=edit_posts&p_id={$the_post_id}'>Update Post</a></li> ";   

                        }


                                }
?>
<li class="<?php echo $registration_class ?>"><a href="registration.php">Register</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>