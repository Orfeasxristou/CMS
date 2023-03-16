
<table class="table table-hover table-bordered ">
<thead>
<tr>
<th>Id</th>
<th>Author</th>
<th>Comment</th>
<th>E-mail</th>
<th>Status</th>
<th>In Response To</th>
<th>Date</th>
<th>Approved</th>
<th>Disaproved</th>
<th>Delete</th>

</tr>
</thead>
<tbody>
<?php
$query="SELECT * FROM comments";
$select_comments=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_comments)){ 
$comment_id=$row['comment_id'];
$comment_post_id=$row['comment_post_id'];
$comment_author=$row['comment_author'];
$comment_date=$row['comment_date'];
$comment_email=$row['comment_email'];
$comment_status=$row['comment_status'];
$comment_content=$row['comment_content'];    
echo '<tr>';
echo "<td>{$comment_id}</td>";
echo "<td>{$comment_author}</td>";
echo "<td>{$comment_content}</td>";
echo "<td>{$comment_email}</td>";
echo "<td>{$comment_status}</td>";
$query="SELECT * FROM posts WHERE post_id=$comment_post_id ";

$select_post_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_post_id)){
$post_title=$row['post_title'];
$post_id=$row['post_id']; 
echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>"; 
}
echo "<td>{$comment_date}</td>";    
echo "<td><a href='comments.php?approved={$comment_id}'>Approved</a></td>"; 
echo "<td><a href='comments.php?disapproved={$comment_id}'>Disapproved</a></td>"; 
echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";    
echo '</tr>';    
}
?>
</tbody>
</table>
<?php
if(isset($_GET['approved'])){
$approved_comments=$_GET['approved'];
$query="UPDATE comments SET comment_status = 'approved' WHERE comment_id={$approved_comments} ";
$approved_comments_query=mysqli_query($connection,$query);
header("Location: comments.php");

                            }
if(isset($_GET['disapproved'])){
$disapproved_comments=$_GET['disapproved'];
$query="UPDATE comments SET comment_status = 'disapproved'WHERE comment_id={$disapproved_comments} ";
$disapproved_comments_query=mysqli_query($connection,$query);
header("Location: comments.php");
                                }

if(isset($_GET['delete'])){
$delete_comments=$_GET['delete'];
$query="DELETE FROM comments WHERE comment_id='{$delete_comments}' ";
$delete_comments_query=mysqli_query($connection,$query);
header("Location: comments.php");
                            }

?>