<?php
if(isset($_GET['p_id'])){
$the_post_id=$_GET['p_id'];
$query="SELECT * FROM posts WHERE post_id=$the_post_id ";
$update_post_id=mysqli_query($connection,$query);

while($row=mysqli_fetch_assoc($update_post_id)){
$post_title=$row['post_title'];
$post_id=$row['post_id'];
$post_author=$row['post_author'];
$post_date=$row['post_date'];
$post_image=$row['post_image'];
$post_content=$row['post_content'];
$post_tags=$row['post_tags'];
$post_comment_count=$row['post_comment_count'];
$post_status=$row['post_status'];
$post_category_id=$row['post_category_id'];
$post_date=$row['post_date'];
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Post Title</label>
<input value="<?php echo $post_title; ?>"type="text" name="post_title" class="form-control">
</div>
<div class="form-group">
<label for="post_category">Categories</label><br>
<select name="post_category" id="post_category">
<?php 
$query="SELECT * FROM categories ";
$select_posts_id=mysqli_query($connection,$query);

while($row=mysqli_fetch_assoc($select_posts_id)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id']; 

echo  "<option value='{$cat_id}'>{$cat_title}</option> "; 
confirmQuery($select_posts_id);
                                                }?>

</select>
</div>
<div class="form-group">
<label for="author">Post Author</label>
<input value="<?php echo $post_author; ?>"type="text" name="author" class="form-control">
</div>
<div class="form-group">
<select name="post_status" id="post_status">
<option value='$post_status'><?php echo $post_status; ?></option>
<?php
if($post_status ==='published' ){

echo  "<option value='draft'>Draft</option> "; 

                                }
    else{

echo  "<option value='published'>Publish</option> "; 
        }
?>
</select>
</div>

<div class="form-group">
<label for="post_image">Post Image</label>
<img  width="50"src="../images/<?php echo $post_image;?>" alt="">
<input type="file" name="image" class="form-control">
</div>
<div class="form-group">
<label for="tags">Post Tags</label>
<input value="<?php echo $post_tags; ?>"type="text" name="tags" class="form-control">
</div>
<div class="form-group">
<label for="content">Post Content</label>
<textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
</div>
<div class="form-group">
<label for="content">Post Date</label>
<input value="<?php echo $post_date; ?>" type= "text"  name="date" class="form-control">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="update_post" value="Update_Post">    
</div>
</form>
<?php } } ?>                    

<?php
//UPDATE QUERY
if(isset($_POST['update_post'])){
$post_title = $_POST['post_title'];
$post_category_id=$_POST['post_category'];
$post_author=$_POST['author'];
$post_status=$_POST['post_status'];
$post_image=$_FILES['image']['name'];
$post_image_temp =$_FILES['image']['tmp_name'];
$post_tags=$_POST['tags'];
$post_content=$_POST['content'];
$post_date=date('d-m-y');

move_uploaded_file($post_image_temp, "../images/$post_image");
if(empty($post_image)){

$query="SELECT * FROM posts WHERE post_id=$post_id ";

$select_image_id=mysqli_query($connection,$query);


while($row=mysqli_fetch_assoc($select_image_id)){
$post_image=$row['post_image'];
                                                }
                        }
$query="UPDATE posts SET post_title = '{$post_title}',post_author ='{$post_author}',post_status='{$post_status}',post_image='{$post_image}',post_tags='{$post_tags}',post_content='{$post_content}',post_date='now()',post_category_id='{$post_category_id}'  WHERE post_id ='{$post_id}'";
$update_post_query=mysqli_query($connection,$query);
if(!$update_post_query){
die("Query Failed" . mysqli_error($connection));
                        }
echo "<p class=bg-success>Post Updated: ". " "."<a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>Edit Other Posts</a></a></p> ";    
}
?>