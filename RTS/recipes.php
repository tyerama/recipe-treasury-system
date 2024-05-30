<?php include('includes/dbconnection.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title -->
    <title>Recipe Treasury System | Home</title>

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




    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### Best Receipe Area Start ##### -->
    <section class="best-receipe-area" style="margin-top:3%">
        <div class="container">
       <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>The Best Recipes</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Single Best Receipe Area -->

<section class="small-receipe-area section-padding-10-0">
        <div class="container">
            <div class="row">

                <!-- Small Receipe Area -->
         <?php
$ret=mysqli_query($con,"select recipeTitle,recipePicture,id from  tblrecipes ");
while ($row=mysqli_fetch_array($ret)) {
?>       
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-receipe-area d-flex">
                        <!-- Receipe Thumb -->
                        <div class="receipe-thumb">
                            <img src="user/images/<?php  echo $row['recipePicture'];?>" alt="<?php  echo $row['recipeTitle'];?>">
                        </div>
                        <!-- Receipe Content -->
                        <div class="receipe-content">
                            <a href="recipe-details.php?rid=<?php  echo $row['id'];?>" target="blank">
                                <h5><?php  echo $row['recipeTitle'];?></h5>
                            </a>
                        </div>
                    </div>
                </div>
<?php } ?>
      

       

       
            </div>
        </div>
    </section>
 


            </div>
        </div>
    </section>


    <!-- ##### Follow Us Instagram Area Start ##### -->
    <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Gallery</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        <div class="insta-feeds d-flex flex-wrap">
            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta1.jpg" alt="">
            
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta2.jpg" alt="">
    
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta3.jpg" alt="">
   
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta4.jpg" alt="">
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta5.jpg" alt="">
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta6.jpg" alt="">
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta7.jpg" alt="">
            </div>
        </div>
    </div>

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