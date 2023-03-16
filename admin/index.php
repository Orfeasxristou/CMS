<?php
include 'includes/admin_header.php'?>
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
</div>
</div>
<!-- /.row -->
<!-- /.row -->
<div class="row">
<div class="col-lg-3 col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-file-text fa-5x"></i>
</div>
<div class="col-xs-9 text-right">
<div class='huge'><?php echo $countposts=recordCount('posts'); ?></div>         
<div>Posts</div>          
</div>
</div>
</div>
<a href="posts.php">
<div class="panel-footer">
<span class="pull-left">View Details</span>
<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
<div class="clearfix"></div>
</div>
</a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-green">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-comments fa-5x"></i>
</div>
<div class="col-xs-9 text-right">
<div class='huge'><?php echo $countcomments=recordCount('comments'); ?></div>   
<div>Comments</div>
</div>
</div>
</div>
<a href="comments.php">
<div class="panel-footer">
<span class="pull-left">View Details</span>
<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
<div class="clearfix"></div>
</div>
</a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-yellow">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-user fa-5x"></i>
</div>
<div class="col-xs-9 text-right">

<div class='huge'><?php echo $countusers=recordCount('users'); ?></div>
<div> Users</div>
</div>
</div>
</div>
<a href="users.php">
<div class="panel-footer">
<span class="pull-left">View Details</span>
<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
<div class="clearfix"></div>
</div>
</a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-red">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-list fa-5x"></i>
</div>
<div class="col-xs-9 text-right">

<div class='huge'><?php echo $countcategories=recordCount('categories'); ?></div>
<div>Categories</div>
</div>
</div>
</div>
<a href="categories.php">
<div class="panel-footer">
<span class="pull-left">View Details</span>
<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
<div class="clearfix"></div>
</div>
</a>
</div>
</div>
</div>
<!-- /.row -->

<?php

$countpublished=checkStatus('posts','post_status','published');     
$countdrafts=checkStatus('posts','post_status','draft');
$countdisapproved=checkStatus('comments','comment_status','disapproved');       
$count_user=checkUser('users','user_role','user');

?>    

<div class="row">
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
['Data','Counts'],
<?php            
$element_text=['All Posts','Active Posts','Draft Posts','Pending Comments','Comments','Subscribers','Users','Categories'];
$element_count=[$countposts,$countpublished,$countdrafts,$countdisapproved,$countcomments,$count_user,$countusers,$countcategories];

for($i=0;$i < 7;$i++){

echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
}        

?>
]);

var options = {
chart: {
title: '',
subtitle: '',
}
};

var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
</script>

<div id="columnchart_material" style="width: 'auto' height: 500px;"></div>

</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php
include 'includes/admin_footer.php';
?>
