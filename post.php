<?php
include 'includes/header.php';
?>

<body>

<!-- Navigation -->
<?php
include 'includes/navigation.php';

?>
<!--Likes Button-->
<?php
if(isset($_POST['liked'])){
$post_id=$_POST['post_id'];
echo "<h1>Orfeas</h1>";
$query="SELECT * FROM posts WHERE post_id='{$post_id}' ";
$result=mysqli_query($connection,$query);
$post=mysqli_fetch_array($result);
$likes=$post['likes'];

if(mysqli_num_rows($result >= 1)){

echo $post['post_id'];
}

$query="UPDATE posts SET likes='{$likes}'+1 WHERE post_id='{$post_id}' ";
$likes_update=mysqli_query($connection,$query);

if(!$likes_update){
echo "QUERY failed";
}
}
?>
<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->

<div class="col-md-8">

<!--POST VIES COUNT QUERY-->
<?php
if(isset($_GET['p_id'])){
$the_post_id=$_GET['p_id'];
$query="UPDATE posts SET post_views_count=post_views_count + 1 WHERE post_id='{$the_post_id}' ";
$post_views_query=mysqli_query($connection,$query);    
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ){

$query="SELECT * FROM posts WHERE post_id='{$the_post_id}'";

}  else {
$query="SELECT * FROM posts WHERE post_id='{$the_post_id}' AND post_status='published' ";

}  

$select_post_query=mysqli_query($connection,$query);
if(mysqli_num_rows($select_post_query) < 1){

echo "<h1 class='text-center'>No Posts!!!</h1>"; 
}
else{





if(!$select_post_query){

echo "Query failed".mysqli_error($connection);
                        }
while($row=mysqli_fetch_assoc($select_post_query)){
$post_title=$row['post_title'];
$post_author=$row['post_author'];
$post_date=$row['post_date'];
$post_image=$row['post_image'];
$post_content=$row['post_content'];
?>

<!-- First Blog Post -->
<h2>
<a href="#"><?php echo $post_title?></a>
</h2>
<p class="lead">
by <a href="index.php"><?php echo $post_author?></a>
</p>
<p><span class="glyphicon glyphicon-time">Posted on <?php echo $post_date?></span></p>
<hr>
<img class="img-responsive" src="images/<?php echo $post_image ?> " alt="">
<hr>
<p><?php echo $post_content?></p>

<hr>
<div class="row">
<p class="pull-right"><a class="like" href=""><span class="glyphicon glyphicon-thumbs-up" ></span>Like</a></p>
</div>
<div class="row">
<p class="pull-right">Likes:10</p>
</div>
<div class="clearfix">
</div>
<?php

} ?> 

<?php
//CREATE COMMENTS QUERY
if(isset($_POST['create_comment'])){
$the_post_id=$_GET['p_id'];
$comment_author=$_POST['comment_author'];
$comment_email=$_POST['comment_email'];
$comment_content=$_POST['comment_content'];

if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content )){
$query="INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
$query .= "VALUES('{$the_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','disaproved',now())";    

$create_comment_query=mysqli_query($connection,$query);
if(!$create_comment_query){

die("Query Failed").mysqli_error($connection);

}

}  else
{

echo "<script>";
echo 'alert("Fields cannnot be empty");';
echo "window.location = '';"; 
echo "</script>";

}
}

?>        

<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
<h4>Leave a Comment:</h4>
<form role="form" action=" " method="post">
<div class="form-group">
<label for="Author">Author</label>
<input type="text" name="comment_author" class="form-container">
</div>
<div class="form-group">
<label for="E-mail">E-mail</label>
<input type="email" name="comment_email" class="form-container">
</div>
<div class="form-group">
<label for="Your Comment">Your Comment</label>
<textarea class="form-control" name="comment_content" rows="3"></textarea>
</div>
<button type="submit" name="create_comment"class="btn btn-primary">Create</button>
</form>
</div>
<hr>
<!--SELECT COMMENTS QUERY-->
<?php
$query="SELECT * FROM comments WHERE comment_post_id='{$the_post_id}' ";
$query .="AND comment_status = 'approved' ";
$query .="ORDER BY comment_id DESC ";
$select_comment_query=mysqli_query($connection,$query);
while ($row=mysqli_fetch_assoc($select_comment_query)){
$comment_content=$row['comment_content'];
$comment_date=$row['comment_date'];
$comment_author=$row['comment_author'];
?>




<!-- Posted Comments -->

<!-- Comment -->
<div class="media">
<a class="pull-left" href="#">
<img class="media-object" src="http://placehold.it/64x64" alt="">
</a>
<div class="media-body">
<h4 class="media-heading"><?php echo $comment_author; ?>
<small><?php echo $comment_date; ?></small>
</h4>
<?php echo $comment_content; ?>
</div>
</div>

<?php } } }else {

header("Location:index.php");

}
?>

<!-- Posted Comments -->


<!--Blog Entries end-->
</div>







<!-- Blog Sidebar Widgets Column -->
<?php
include 'includes/sidebar.php';
?>
<!-- /.row -->
</div>
<!--container-->
</div>




<hr>

<!-- Footer -->
<?php
include 'includes/footer.php';
?>

<script>
$(document).ready(function(){
var post_id= <?php echo $the_post_id; ?> 
var user_id=65;               
$('.like').click (function(){

$.ajax({

url: "post.php?p_id=<?php echo $the_post_id; ?>",
type:"post",   
data: {
'liked' :1,
'post_id':post_id ,    
'user_id': user_id
}
});
});
});

</script>

