<?php
function escape($string){
global $connection;
return mysqli_real_escape_string($connection, trim($string));
}
function reDirect($location){
return header("Location :".$location);
exit;
}
global $connection;
function confirmQuery($result){
global $connection;

if(!$result){

die('Query Failed'.mysqli_error($connection));
}

}
function users_online(){
global $connection;
$session=session_id();
$time=time();
$time_out_in_seconds=05;
$time_out=$time - $time_out_in_seconds;
$query="SELECT * FROM users_online WHERE session='{$session}' ";
$online_query=mysqli_query($connection,$query);
$count=mysqli_num_rows($online_query);
if($count == NULL){

mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('{$session}','{$time}') ");

                    }
    else{

mysqli_query($connection, "UPDATE users_online SET time ='{$time}' WHERE session ='{$session}' ");

$users_online_query=mysqli_query($connection, "SELECT * FROM users_online WHERE time > '{$time_out}'");
return $count_users=mysqli_num_rows($users_online_query);

        }
}        

function insert_posts()
{
global $connection;
if(isset($_POST['create_post'])){
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

$query="INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
// H sunexeia tou $query
$query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' )";

$insert_query_posts=mysqli_query($connection,$query);

confirmQuery($insert_query_posts);

$the_post_id=mysqli_insert_id($connection);

echo "<p class=bg-success>Post Updated: ". " "."<a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>Add Other Posts</a></a></p> ";
}

}

function insert_users()
{
global $connection;
if(isset($_POST['add_user'])){
$username=$_POST['username'];
$user_password=$_POST['user_password'];
$user_firstname=$_POST['user_firstname'];
$user_lastname=$_POST['user_lastname'];
$user_email=$_POST['user_email'];
$user_role=$_POST['user_role'];
$user_password= password_hash($user_password, PASSWORD_BCRYPT,array('cost'=>12));

$query="INSERT INTO users(username,user_password, user_firstname, user_lastname, user_email, user_role) ";
// H sunexeia tou $query
$query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}' )";

$insert_query_users=mysqli_query($connection,$query);

confirmQuery($insert_query_users);
echo "User Created: ". " "."<a href='users.php'>View Users</a> ";
}
}


function insert_categories()
{
global $connection;
//ADD QUERY HERE
if(isset($_POST['submit'])){
$cat_title=$_POST['cat_title'];
if($cat_title == '' || empty($cat_title)){
echo "This should not be empty";
                                        }
else{

$query="INSERT INTO categories(cat_title) VALUES ('{$cat_title}') ";
$add_categories=mysqli_query($connection,$query);
if(!$add_categories){
die("Query Failed" . mysqli_error($connection));
}
    }
                            }
}

function delete_categories(){
global $connection;
//DELETE QUERY
if(isset($_GET['delete'])){
$cat_id=$_GET['delete'];

$query="DELETE FROM categories WHERE cat_id='{$cat_id}'";
$delete_categories=mysqli_query($connection,$query);
                            }
}
function showAll_categories(){
global $connection;
//SHOW ALL CATEGORIES IN A TABLE
$query="SELECT * FROM categories";
$select_categories=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_categories)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];   
echo '<tr>';
echo "<td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";
echo "<td><a href='categories.php?delete={$cat_id}'>Delete<a/></td>";
echo "<td><a href='categories.php?update={$cat_id}'>Update<a/></td>";    
echo '</tr>';    

                                                }

                            }

function recordCount($table){
global $connection;
$query="SELECT * FROM .$table";
$select_allposts_query=mysqli_query($connection,$query);
$result=mysqli_num_rows($select_allposts_query);  
confirmQuery($result);
return $result;
                            }

function checkStatus($table,$column,$status){
global $connection;
$query="SELECT * FROM $table WHERE $column='$status' ";
$select_allpublished_query=mysqli_query($connection,$query);
$result=mysqli_num_rows($select_allpublished_query);
return $result;
                                            }

function checkUser($table,$column,$role){
global $connection;
$query="SELECT * FROM $table WHERE $column='$role'";
$select_users_query=mysqli_query($connection,$query);
$result=mysqli_num_rows($select_users_query);
return $result;
                                        }


function is_admin($username){
global $connection;
$query="SELECT user_role FROM users WHERE username ='{$username}' ";
$result=mysqli_query($connection,$query);
confirmQuery($result);
$row = mysqli_fetch_array($result);    
if($row['user_role'] == 'admin'){
return true;
                                }
    else{

return false;
        }

}

function username_exists($username){
global $connection;
$query="SELECT username FROM users WHERE username ='{$username}' ";
$result=mysqli_query($connection,$query);
confirmQuery($result);
if( mysqli_num_rows($result)  > 0){
return true;
                                }
    else{

return false;
        }
}

function email_exists($email){
global $connection;
$query="SELECT user_email FROM users WHERE user_email ='{$email}' ";
$result=mysqli_query($connection,$query);
confirmQuery($result);
if( mysqli_num_rows($result)  > 0){
return true;
                                }
    else{

return false;
        }       

}

function register_user($username,$firstname,$lastname,$email,$password){
global $connection;
$username=mysqli_real_escape_string($connection,$username);
$firstname=mysqli_real_escape_string($connection,$firstname); 
$lastname=mysqli_real_escape_string($connection,$lastname);         
$email=mysqli_real_escape_string($connection,$email);
$password=mysqli_real_escape_string($connection,$password);
$password= password_hash($password, PASSWORD_BCRYPT,array('cost'=>12));
$query="INSERT INTO users(username,user_firstname,user_lastname,user_email,user_password,user_role) ";
// H sunexeia tou $query
$query .= "VALUES('{$username}','{$firstname}','{$lastname}', '{$email}','{$password}','user' )";

$insert_query_salt=mysqli_query($connection,$query);

confirmQuery($insert_query_salt);
}    

function login_user($username,$password){
global $connection;
$username=mysqli_real_escape_string($connection,$username);
$password=mysqli_real_escape_string($connection,$password);
$query="SELECT * FROM users WHERE username='{$username}' ";
$select_user_query=mysqli_query($connection,$query);

if(!$select_user_query){
die("Query Failed".mysqli_error($connection));
                        }

while($row=mysqli_fetch_assoc($select_user_query)){
$db_username=$row['username'];
$db_user_id=$row['user_id'];
$db_user_password=$row['user_password'];
$db_user_firstname=$row['user_firstname'];
$db_user_lastname=$row['user_lastname'];
$db_user_role=$row['user_role'];
                                                }   

if(password_verify($password,$db_user_password)){
$_SESSION['username']=$db_username;
$_SESSION['firstname']=$db_user_firstname;
$_SESSION['laastname']=$db_user_lastname;
$_SESSION['user_role']=$db_user_role;    
header("Location: ../index.php");

                                                }
    else{

header("Location: ../index.php");
        }
}
?>