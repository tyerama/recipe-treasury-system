<?php   session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['rtsaid']==0)) {
  header('location:logout.php');
  } else{
// Code for comment Approval   
if($_GET['action']=='approve'){
$cid=intval($_GET['cid']);
$query=mysqli_query($con,"update tblcomments set status='1' where id='$cid'");
if($query){
unlink($ppicpath);
echo "<script>alert('Comment approved successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'approved-comments.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}}
// Code for comment reject   
if($_GET['action']=='reject'){
$cid=intval($_GET['cid']);
$query=mysqli_query($con,"update tblcomments set status='0' where id='$cid'");
if($query){
unlink($ppicpath);
echo "<script>alert('Comment rejected successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'rejected-comments.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}}
?>


<!DOCTYPE html>
<head>
<title>Recipe Treasury System | Rejected Comments </title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<?php include_once('includes/header.php');?>
<!--header end-->
<!--sidebar start-->
<?php include_once('includes/sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
    Manage Rejected Comments
    </div>
    <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <thead>
          <tr>
            <th data-breakpoints="xs">#</th>
            <th>Recipe Title</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Comment Date</th>

            <th data-breakpoints="xs">Action</th>
           
           
          </tr>
        </thead>
        <?php
$ret=mysqli_query($con,"SELECT tblrecipes.recipeTitle,tblrecipes.id as rid, tblcomments.* FROM `tblcomments` join tblrecipes on tblrecipes.id=tblcomments.recipeId where tblcomments.status='0'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
        <tbody>
          <tr data-expanded="true">
            <td><?php echo $cnt;?></td>
            <td><a href="edit-recipe.php?recipeid=<?php echo $row['rid'];?>" target="blank"><?php  echo $row['recipeTitle'];?></a></td>
            <td><?php  echo $row['userName'];?></td>
              <td><?php  echo $row['userEmail'];?></td>
              <td><?php  echo $row['commentMessage'];?></td>
              <td><button class="btn btn-danger btn-xs">Rejected</button></td>
                  <td><?php  echo $row['postingDate'];?></td>
                  <td>
                     <a href="new-comments.php?action=approve&&cid=<?php echo $row['id']; ?>"  title="Approve this comment" onclick="return confirm('Do you really want to approve this comment?');" class="btn btn-success btn-xs">Approve </a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
 </tbody>
            </table>
            
            
          
    </div>
  </div>
</div>
</section>
 <!-- footer -->
		 <?php include_once('includes/footer.php');?>  
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
<?php }  ?>