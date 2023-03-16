<?php
if(isset($_POST['checkBoxesArray'])){

foreach($_POST['checkBoxesArray'] as $checkBoxesValues){

$bulk_options = $_POST['bulk_options'];

switch($bulk_options){

case 'published':
$query="UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id='{$checkBoxesValues}' ";
$bolkoptions_publish_query=mysqli_query($connection,$query);
break;

case 'draft':
$query="UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id='{$checkBoxesValues}' ";
$bolkoptions_draft_query=mysqli_query($connection,$query);
break;

case 'delete':
$query="DELETE FROM posts WHERE post_id='{$checkBoxesValues}' ";
$delete_values=mysqli_query($connection,$query);

break;
case 'clone':                
$query="SELECT * FROM posts WHERE post_id='{$checkBoxesValues}' ";
$select_copy_posts=mysqli_query($connection,$query);


while($row=mysqli_fetch_assoc($select_copy_posts)){
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
                                                }
$query="INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
// H sunexeia tou $query
$query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' )";

$copy_query_posts=mysqli_query($connection,$query);

confirmQuery($copy_query_posts);

break;

default:
include "includes/view_allposts.php";
break;   
}


}
}
?>
<form action="" method="post">
<table class="table table-hover table-bordered ">
<div id="bulkoptionscontainer" class="col-xs-4"> 
<select name="bulk_options" class="form-control" id="bulk_options">
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select>
</div>
<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply"> 
<a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>   
</div>
<thead>
<tr>
<th><input type="checkbox" name="select_allboxes" id="select_allboxes"></th>
<th>Id</th>
<th>Title</th>
<th>Author</th>
<th>Category</th>
<th>Status</th>
<th>Image</th>
<th>Tags</th>
<th>Comments</th>
<th>Date</th>
<th>Number of Views</th>
<th>Delete</th>
<th>Update</th>
<th>View</th>
</tr>
</thead>
<tbody>    
<?php
$query="SELECT * FROM posts ORDER BY post_id DESC";

//------------ TABLE JOIN **** --------------        
//$query="SELECT posts.post_id,posts.post_title,posts.post_author,posts.post_date,posts.post_image,posts.post_content,posts.tags,posts.post_comment_count,posts.post_status,";
//$query .= "posts.post_category_id,posts.post_views_count,categories.cat_id,categories.cat_title ";
//$query .="FROM posts";
//$query .="LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";        
$select_posts=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_posts)){
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
$post_views_count=$row['post_views_count'];  
echo '<tr>';
?>
<td><input class='checkBoxes' type='checkbox' name='checkBoxesArray[]' id='check_allboxes' value='<?php echo $post_id;  ?>'></td>
<?php    
echo "<td>{$post_id}</td>";
echo "<td>{$post_title}</td>";
echo "<td>{$post_author}</td>";
$query="SELECT * FROM categories WHERE cat_id={$post_category_id} ";
$show_categories_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($show_categories_id)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id']; 
echo "<td>{$cat_title}</td>"; 
                                                    }
echo "<td>{$post_category_id}</td>";
echo "<td>{$post_status}</td>";    
echo "<td><img width='100' src='../images/$post_image' alt='image.jpeg'></td>";
echo "<td>{$post_tags}</td>";
$query="SELECT * FROM comments WHERE comment_post_id='{$post_id}' ";
$count_comment_query=mysqli_query($connection,$query);
$count_comments=mysqli_num_rows($count_comment_query);
echo "<td>{$count_comments}</td>";
echo "<td>{$post_date}</td>";   
echo "<td>{$post_views_count}</td>";     
echo "<td><a onClick=\"; javascript: return confirm('Are you Sure you want to delete'); \"; href='posts.php?delete={$post_id}'>Delete</a></td>";    
echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Update<a/></td>"; 
echo "<td><a href='../post.php?p_id={$post_id}'>View Post<a/></td>";     
echo '</tr>';    
}
?>
</tbody>
</table>
</form>
<?php
if(isset($_GET['delete'])){
$delete_posts=$_GET['delete'];
$query="DELETE FROM posts WHERE post_id=$delete_posts";
$delete_posts_query=mysqli_query($connection,$query);
header("Location: posts.php");
                            }
?>
