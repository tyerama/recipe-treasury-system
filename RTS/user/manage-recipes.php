<?php   session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['rtsuid']==0)) {
  header('location:logout.php');
  } else{
 // Code for deletion   
if($_GET['action']=='delete'){
$rid=intval($_GET['bsid']);
$query=mysqli_query($con,"delete from tblrecipes where id='$rid'");
if($query){
unlink($ppicpath);
echo "<script>alert('Recipe deleted successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-recipes.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}

}
?>


<!DOCTYPE html>
<head>
<title>Recipe Treasury System || Manage Recipe Detail </title>

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
    Manage Recipes Details
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
            <th data-breakpoints="xs">S.NO</th>
            <th>Recipe Title</th>
            <th>Recipe Prep. Time</th>
            <th>Recipe Cook Time</th>
            <th>Recipe Yields</th>
            <th>Listing Date</th>
            <th data-breakpoints="xs">Action</th>
           
           
          </tr>
        </thead>
        <?php
$uid=$_SESSION['rtsuid'];
$ret=mysqli_query($con,"select * from tblrecipes where userId='$uid' ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
        <tbody>
          <tr data-expanded="true">
            <td><?php echo $cnt;?></td>
            <td><?php  echo $row['recipeTitle'];?></td>
            <td><?php  echo $row['recipePrepTime'];?> Minutes</td>
              <td><?php  echo $row['recipeCookTime'];?> Minutes</td>
              <td><?php  echo $row['recipeYields'];?> Serves</td>
                  <td><?php  echo $row['postingDate'];?></td>
                  <td><a href="edit-recipe.php?recipeid=<?php echo $row['id'];?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="manage-recipes.php?action=delete&&bsid=<?php echo $row['id']; ?>"  title="Delete this record" onclick="return confirm('Do you really want to delete this record?');" class="btn btn-danger btn-xs">Delete </a>
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