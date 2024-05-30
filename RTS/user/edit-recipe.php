<?php
session_start();
//error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['frsuid']==0)) {
  header('location:logout.php');
  }
  else{

if(isset($_POST['update']))
  {
   $recipeid=intval($_GET['recipeid']);
$uid=$_SESSION['frsuid'];
    $recipetitle=$_POST['recipetitle'];
    $recipeprep=$_POST['recipeprep'];
    $recipecooktime=$_POST['recipecooktime'];
    $yields=$_POST['yields'];
    $description=$_POST['description'];
    $fid=mt_rand(100000000, 999999999);
    $picdata=$_FILES["images"]["name"];
     if($picdata==''):
         $pic=$_POST["image"];
         else:
            $pic=$picdata;
     endif;
     $extension = substr($pic,strlen($pic)-4,strlen($pic));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.

if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}else{
    if($picdata==''):
$foodpic=$_POST["image"];
else:
$foodpic=md5($pic.time()).$extension;
endif;    
if($picdata!=''):
move_uploaded_file($_FILES["images"]["tmp_name"],"images/".$foodpic);
endif;
//Getting post values
$fitem=$_POST["fitem"]; 
$fitemarray=implode(",",$fitem);
    $query=mysqli_query($con, "update tblrecipes set recipeTitle='$recipetitle',recipePrepTime='$recipeprep',recipeCookTime='$recipecooktime',recipeYields='$yields',recipeIngredients='$fitemarray',recipeDescription='$description',recipePicture='$foodpic' where userId='$uid' and id='$recipeid'");

    if ($query) {
    echo "<script>alert('Recipe Detail updated successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-recipes.php'; </script>";
  }
  else
    {
     echo "<script>alert('Something went wrong. Please try again.');</script>";
    }

}
}
  ?>
<!DOCTYPE html>
<head>
<title>Food Recipe System   | Add Recipe Detail </title>

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

<script>
function getCity(val) { 
  $.ajax({
type:"POST",
url:"get-city.php",
data:'sateid='+val,
success:function(data){
$("#city").html(data);
}});
}
 </script>
<script>
$(document).ready(function(){
var i=1;
$('#add').click(function(){
i++;
$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="fitem[]" placeholder="Enter Recipe Ingredient" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
});
    
$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id"); 
$('#row'+button_id+'').remove();
});
});
</script>
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
	<div class="form-w3layouts">
    
        <div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                List Your Recipe Details
            </header>
            <div class="panel-body">
                
      <?php
$recipeid=intval($_GET['recipeid']);
$uid=$_SESSION['frsuid'];
$ret=mysqli_query($con,"select * from  tblrecipes where userId='$uid' and id='$recipeid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>


                <form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">

                   <div class="form-group">
                        <label class="col-sm-3 control-label">Recipe Title </label>
                        <div class="col-sm-6">
                            <input class="form-control" id="recipetitle" name="recipetitle" value="<?php  echo $row['recipeTitle'];?>" type="text" required="true" value="">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="col-sm-3 control-label">Recipe Preperation Time <small>(in minutes)</small></label>
                        <div class="col-sm-6">
                            <input class="form-control" id="recipeprep" name="recipeprep" value="<?php  echo $row['recipePrepTime'];?>" pattern="[0-9]+" type="text" required="true" title="Numbers only">
                        </div>
                    </div>


         <div class="form-group">
                        <label class="col-sm-3 control-label">Recipe Cook Time <small>(in minutes)</small></label>
                        <div class="col-sm-6">
                            <input class="form-control" id="recipecooktime" name="recipecooktime" value="<?php  echo $row['recipeCookTime'];?>"  pattern="[0-9]+" type="text" required="true" title="Numbers only">
                        </div>
                    </div>


        <div class="form-group">
                        <label class="col-sm-3 control-label">Yields <small>(Eg: 8 Servings)</small></label>
                        <div class="col-sm-6">
                            <input class="form-control" id="yields" name="yields" value="<?php  echo $row['recipeYields'];?>"  pattern="[0-9]+" type="text" required="true" title="Numbers only">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Recipe Ingredients</label>
                        <div class="col-sm-6">
                            <table class="table table-bordered" id="dynamic_field">
<tr>
<td><input type="text" name="fitem[]" placeholder="Enter Recipe Ingredient" value="<?php  echo $row['recipeIngredients'];?>" class="form-control name_list" /></td>
<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
</tr>
</table>
                        </div>
                    </div>
               

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="description" name="description" rows="10" type="text" required="true" value=""><?php  echo $row['recipeDescription'];?>
</textarea>                        </div>
                    </div>
      
         
            
                
             
       
                   
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Pictures</label>
                        <div class="col-lg-6">
                            <img src="images/<?php  echo $row['recipePicture'];?>" width="300"><br /><br />
                              <input type="hidden" class="form-control" name="image" id="image" value="<?php  echo $row['recipePicture'];?>">
                             <input type="file" class="form-control" name="images" id="images" >
                        </div>
                    </div>
                
                    

                    <hr />
<div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit" name="update">Update</button>
                                    </div>
                                </div>

                </form>

<?php } ?>

            </div>
        </section>



        <!-- page end-->
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
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
<?php  } ?>
