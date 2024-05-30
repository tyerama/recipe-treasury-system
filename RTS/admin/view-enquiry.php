<?php  session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['rtsaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit'])){
  $aremark=$_POST['adminremark'];
   $eid=intval($_GET['enqid']);
  $query=mysqli_query($con, "update tblenquiry set adminRemark ='$aremark' where id='$eid'");
echo "<script>alert('Comment rejected successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'readenq.php'; </script>";

}

?>

<!DOCTYPE html>
<head>
<title>Recipe Treasury System | View Enquiry </title>
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
     View Enquiry Details
    </div>
    <div><?php
             $eid=intval($_GET['enqid']);
$ret=mysqli_query($con,"select * from tblenquiry where id=$eid");
while ($row=mysqli_fetch_array($ret)) {

?>
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
        
              
                <tr>
    <th scope style="font-size: 15px;">Name</th>
    <td><?php  echo $row['userName'];?></td>
    <th style="font-size: 15px;" scope>Email</th>
    <td><?php  echo $row['userEmail'];?></td>
  </tr>
  <tr>
   <th style="font-size: 15px;" scope>Subject</th>
    <td><?php  echo $row['subject'];?></td>
       <th style="font-size: 15px;" scope>Enq. Posting Date</th>
    <td><?php  echo $row['postingDate'];?></td>
                </tr>
                <tr>
    
    <th style="font-size: 15px;">Message</th>
    <td colspan="4"><?php  echo $row['commentMessage'];?></td>
  </tr>
<?php if($row['adminRemark']!=''): ?>
              <tr>
    
    <th style="font-size: 15px;">Admin Remark</th>
    <td colspan="4"><?php  echo $row['adminRemark'];?></td>
  </tr>
  <tr>
   <th style="font-size: 15px;" scope>Admin Remark Date</th>
    <td><?php  echo $row['updationDate'];?></td>
  <?php endif; if($row['adminRemark']==''): ?>
  <form method="post">
  <tr>
       <th style="font-size: 15px;">Admin Remark</th>
    <td colspan="4">
      <textarea class="form-control" name="adminremark" rows="5" required></textarea>
    </td>

  </tr>
  <tr>
    <td><input class="btn btn-primary" type="submit" name="submit"></td>
  </tr>
</form>
<?php endif;?>
            </table><?php $cnt=$cnt+1;} ?>
            
            
          
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