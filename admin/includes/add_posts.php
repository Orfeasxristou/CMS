<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Post Title</label>
<input type="text" name="post_title" class="form-control">
</div>
<div class="form-group">
<label for="post_category">Post Category </label><br>
<select name="post_category" id="post_category">

<?php
$query="SELECT * FROM categories ";
$select_posts_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_posts_id)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id']; 
echo  "<option selected value='{$cat_id}'>{$cat_title}</option> "; 
confirmQuery($select_posts_id);
if($cat_id == $post_category_id){
echo  "<option value='{$cat_id}'>{$cat_title}</option> "; 
                                }
    else{

        }
                                                }?>
</select>
</div>
<div class="form-group">
<label for="author">Post Author</label>
<input type="text" name="author" class="form-control">
</div>
<div class="form-group">
<label for="post_status">Post Status</label><br>
<select name="post_status" id="post_status">
<option value="draft">Select Options</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
</select>
</div>
<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" name="image" class="form-control">
</div>
<div class="form-group">
<label for="tags">Post Tags</label>
<input type="text" name="tags" class="form-control">
</div>
<div class="form-group">
<label for="content">Post Content</label>
<textarea class="form-control" name="content" id="summernote" cols="30" rows="10"></textarea>
</div>
<div class="form-group">
<label for="date">Post Date</label>
<input type="text" name="date" class="form-control">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="create_post" value="Create_Post">    
</div>
</form>
<?php 
insert_posts();
?>