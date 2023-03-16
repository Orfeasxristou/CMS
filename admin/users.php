<?php
include 'includes/admin_header.php';
?>
<?php
if(!is_admin($_SESSION['username'])){
header("Location :index.php");
                                    }
?>
<div id="wrapper">
<?php
include 'includes/admin_navigation.php';
?>
<!--Page Wrepper-->
<div id="page-wrapper">
<!--Container Fluid-->
<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">

<h1 class="page-header">
Welcome Admin
<small><?php echo $_SESSION['username']; ?></small>
</h1>

<!--SWICH CASE METHOD-->
<?php 
if(isset($_GET['source'])){
$source = $_GET['source'];

                        }
else{
$source='';

            }
switch($source){

case 'add_users';
echo include 'includes/add_users.php';
break;

case 'edit_users';
echo include 'includes/edit_users.php';
break;
default:
include "includes/view_allusers.php";
break;
}    
?>
<div class="col-xs-12">


</div>
<!--./col-xs-12-->
</div>
<!--col-lg-12-->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
<!-- /#page-wrapper -->
<?php
include 'includes/admin_footer.php';
?>
