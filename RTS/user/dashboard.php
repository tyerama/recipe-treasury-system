<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['rtsuid']==0)) {
  header('location:logout.php');
  } 
     ?>
<!DOCTYPE html>
<head>
<title>Recipe Treasury System | dashboard </title>
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
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->

<!--header end-->
<?php include_once('includes/header.php');?>
<!--sidebar start-->

<!--sidebar end-->
<?php include_once('includes/sidebar.php');?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="icon-food fa-3x"> </i>
					</div>
					
					<?php 
$uid=$_SESSION['rtsuid'];
$query=mysqli_query($con,"Select * from  tblrecipes where userId='$uid'");
$fcounts=mysqli_num_rows($query);
?>
					 <div class="col-md-8 market-update-left">
					 <a href="manage-recipes.php"><h4>Total Food Recipe(s)</h4></a>
					<h3><?php echo $fcounts;?></h3>
					
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="market-updates">
            <!-- Existing market update blocks -->
            
            <!-- Add the new block for Recipe Recommendation -->
            <div class="col-md-4 market-update-gd">
                <div class="market-update-block clr-block-6">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-book fa-3x"></i> <!-- Font Awesome icon for a book -->
                    </div>
                    <?php 
$uid=$_SESSION['rtsuid'];
$query=mysqli_query($con,"Select * from  tblrecipes where userId='$uid'");
$fcounts=mysqli_num_rows($query);
?>
                    <div class="col-md-8 market-update-left">
                        <a href="rcmnddashboard.php"><h4>Recipe Recommendation</h4></a>
                        <p>Get personalized recipe recommendations!</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


	<?php 
	$query=mysqli_query($con,"select tblcomments.id from tblcomments join tblrecipes on tblrecipes.id=tblcomments.recipeId where tblrecipes.userId='$uid'");
$allcomments=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd" style="margin-top:1%;">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-comment fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="all-comments.php"><h4>All Comments </h4></a>
						<h3><?php echo $allcomments;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>	

			<?php 
$query=mysqli_query($con,"select tblcomments.id from tblcomments join tblrecipes on tblrecipes.id=tblcomments.recipeId where tblrecipes.userId='$uid' and status is null");
$newcomments=mysqli_num_rows($query);
?>
			<div class="col-md-4 market-update-gd" style="margin-top:1%;">
				<div class="market-update-block clr-block-5">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-comment fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="new-comments.php"><h4>New Comments </h4></a>
						<h3><?php echo $newcomments;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>	

			<?php 
$query1=mysqli_query($con,"select tblcomments.id from tblcomments join tblrecipes on tblrecipes.id=tblcomments.recipeId where tblrecipes.userId='$uid' and status='0'");
$rejected=mysqli_num_rows($query1);
?>
			<div class="col-md-4 market-update-left" style="margin-top:1%;">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-comment fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="rejected-comments.php"><h4>Rejected Comments </h4></a>
						<h3><?php echo $rejected;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>	


			<?php 
$query2=mysqli_query($con,"select tblcomments.id from tblcomments join tblrecipes on tblrecipes.id=tblcomments.recipeId where tblrecipes.userId='$uid' and status='1'");
$approved=mysqli_num_rows($query2);
?>
			<div class="col-md-4 market-update-gd" style="margin-top:1%;">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-comment fa-3x" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<a href="approved-comments.php"><h4>Approved Comments </h4></a>
						<h3><?php echo $approved;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>





		   <div class="clearfix"> </div>
		</div>	
		
	
			<!-- tasks -->
		

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
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
