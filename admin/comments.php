<?php
include 'includes/admin_header.php';
?>
<div id="wrapper">
<?php
include 'includes/admin_navigation.php';
?>
<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
Welcome Admin
<small><?php echo $_SESSION['username']; ?></small>
</h1>
<div class="col-xs-12">
<?php 
if(isset($_GET['source'])){
$source = $_GET['source'];
                        }
else
{
$source='';

}
switch($source){

case 'add_posts';
echo include 'includes/add_posts.php';
break;

case 'edit_posts';
echo include 'includes/edit_posts.php';
break;
default:
include "includes/view_allcomments.php";
break;
                }    
?>
</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php
include 'includes/admin_footer.php';
?>
