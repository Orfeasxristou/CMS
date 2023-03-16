
<table class="table table-hover table-bordered ">
<thead>
<tr>
<th>Id</th>
<th>Username</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>Access</th>
<th>Delete</th>
<th>Edit</th>
<th>Upgrade</th>
<th>Disgraded</th>
</tr>
</thead>
<tbody>
<!--SELECT FORM USERS QUERY-->
<?php
$query="SELECT * FROM users";
$select_users=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_users)){
$username=$row['username'];
$user_id=$row['user_id'];
$user_password=$row['user_password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];
$user_image=$row['user_image'];
$user_role=$row['user_role'];
echo '<tr>';
echo "<td>{$user_id}</td>";
echo "<td>{$username}</td>";
echo "<td>{$user_firstname}</td>";
echo "<td>{$user_lastname}</td>";
echo "<td>{$user_email}</td>";    
echo "<td>{$user_role}</td>";   
echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
echo "<td><a href='users.php?source=edit_users&p_id={$user_id}'>Edit<a/></td>"; 
echo "<td><a href='users.php?upgraded={$user_id}'>Upgrade</a></td>"; 
echo "<td><a href='users.php?disgraded={$user_id}'>Disgrade</a></td>";
                                }
?>
</tbody>
</table>
<!--DELETE LINK-->
<?php
if(isset($_GET['delete'])){
if(isset($_SESSION['user_role'])){
if($_SESSION['user_role'] == 'admin'){

$delete_users=mysqli_real_escape_string($connection,$_GET['delete']);

$query="DELETE FROM users WHERE user_id=$delete_users";
$delete_users_query=mysqli_query($connection,$query);
header("Location: users.php");
                                    }
                                }
                            }
//UPGRADE LINK
if(isset($_GET['upgraded'])){
$upgrade_role=$_GET['upgraded'];
$query="UPDATE users SET user_role = 'admin' WHERE user_id={$upgrade_role} ";
$upgrade_role_query=mysqli_query($connection,$query);
header("Location: users.php");

                            }
//DISGRADE LINK
if(isset($_GET['disgraded'])){
$disgraded_role=$_GET['disgraded'];
$query="UPDATE users SET user_role = 'user' WHERE user_id={$disgraded_role} ";
$disgraded_role_query=mysqli_query($connection,$query);
header("Location: users.php");
                            }
?>