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
<div class="col-xs-6">
<?php
insert_categories();
//ADD CATEGORIES FINISH HERE
delete_categories();  
?>
<form action=" " method="post">
<div class="form-group">
<label for="cat_title">Add Categories</label>
<input type="text" class="form-control" name="cat_title">    
</div>
<div class="form-group">
<input class="btn btn-primary" type="submit"name="submit" value="Add category"> 
</div>
</form>

<?php
if(isset($_GET['update']))  {
$cat_id = $_GET['update'];
include 'includes/update_categories.php';
}
?>    
</div>
<div class="col-xs-6">
<table class="table table-hover">
<thead>
<tr>
<th>Id</th>
<th>Category Title</th>
</tr>
</thead>
<tbody>
<?php showAll_categories(); ?> 
</tbody>
</table>
</div>
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
