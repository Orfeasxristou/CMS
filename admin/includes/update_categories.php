<form action=" " method="post">
<div class="form-group">
<label for="cat_title">Update Categories</label>
<?php
if(isset($_GET['update'])){
$cat_id=$_GET['update'];
$query="SELECT * FROM categories WHERE cat_id=$cat_id ";
$update_categories_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($update_categories_id)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id']; 
?>
<input value="<?php if(isset($cat_title)){echo $cat_title;}?>" type="text" class="form-control" name="cat_title">
<?php } }
?>                    
<?php
//UPDATE QUERY
if(isset($_POST['update_category'])){
$the_cat_title=$_POST['cat_title'];
$query="UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id ='{$cat_id}'";
$update_query=mysqli_query($connection,$query);
if(!$update_query){
die("Query Failed" . mysqli_error($connection));
                    }
                                    }
?>
</div>
<div class="form-group">
<input class="btn btn-primary" type="submit"name="update_category" value="Update category">    
</div>
</form>