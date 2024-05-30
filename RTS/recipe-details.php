<?php include('includes/dbconnection.php');
//code for comment
if(isset($_POST['submit']))
  {
    $fname=$_POST['fname'];
    $emailid=$_POST['emailid'];
    $message=$_POST['message'];
$recipeid=intval($_GET['rid']);
    $query=mysqli_query($con, "insert into tblcomments(recipeId,userName,userEmail,commentMessage) value('$recipeid','$fname','$emailid','$message' )");
    if ($query) {
    echo "<script>alert('Comment added succesfuuly. After moderation it will show');</script>";
  }
  else
    {
       echo "<script>alert('Something went wrong . Please try again.');</script>";
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Recipe Treasury System  | Recipe Details</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

       <?php include_once('includes/topbar.php');?>
    <!-- ##### Header Area Start ##### -->
       <?php include_once('includes/header.php');?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Recipe</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="receipe-post-area section-padding-80">
<?php
$recipeid=intval($_GET['rid']);
$ret=mysqli_query($con,"select * from  tblrecipes where id='$recipeid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) { 

    ?>

        <!-- Receipe Slider -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="receipe-slider owl-carousel">
                        <img src="user/images/<?php  echo $row['recipePicture'];?>" alt="<?php  echo $row['recipeTitle'];?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipe Content Area -->
        <div class="receipe-content-area">
            <div class="container">

                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="receipe-headline my-5">
                            <span><?php  echo $row['postingDate'];?></span>
                            <h2><?php  echo $row['recipeTitle'];?></h2>
                            <div class="receipe-duration">
                                <h6>Prep: <?php  echo $row['recipePrepTime'];?> mins</h6>
                                <h6>Cook: <?php  echo $row['recipeCookTime'];?> mins</h6>
                                <h6>Yields: <?php  echo $row['recipeYields'];?> Servings</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="receipe-ratings text-right my-5">
                            <a href="#" class="btn delicious-btn">For Beginners</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <!-- Single Preparation Step -->
                        <div class="single-preparation-step d-flex">
                            <p><?php  echo $row['recipeDescription'];?> </p>
                        </div>
          

                    </div>
<?php $arr = explode(",",$row['recipeIngredients']);?>
                    <!-- Ingredients -->
                    <div class="col-12 col-lg-4">
                        <div class="ingredients">
                            <h4>Ingredients</h4>

                            <!-- Custom Checkbox -->
<?php
foreach ($arr as $ingredients) {

?>


                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="<?php echo $ingredients;?>">
                               <?php echo "<label class='custom-control-label' for='$ingredients'>$ingredients</label>" ?>
                            </div>
<?php } ?>
                 



                        </div>
                    </div>
                </div>
<?php } ?>
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-left">
                            <h3>Leave a comment</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="contact-form-area">
                            <form  method="post">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="fname" required>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="emailid" required>
                                    </div>
      
                                    <div class="col-12">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message" name="message" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn delicious-btn mt-30" type="submit" name="submit">Post Comments</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<?php $ret=mysqli_query($con,"select userName,commentMessage,postingDate from tblcomments where status=1 and recipeId='$recipeid'");
while ($row=mysqli_fetch_array($ret)) {
?>
  <div class="card" style="margin-top: 2%;">
    <div class="card-body">
        <b><?php  echo $row['userName'];?> <small>(<?php  echo $row['postingDate'];?>)</small></b>
        <p><?php  echo $row['commentMessage'];?></p>

    </div>
  </div>
<?php } ?>

</div>

            </div>



        </div>
    </div>

    <!-- ##### Follow Us Instagram Area Start ##### -->
    <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Follow Us Instragram</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        <div class="insta-feeds d-flex flex-wrap">
            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta1.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta2.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta3.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta4.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta5.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta6.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta7.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Follow Us Instagram Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
<?php include_once('includes/footer.php');?>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>