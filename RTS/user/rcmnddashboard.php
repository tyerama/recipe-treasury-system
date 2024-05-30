<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['rtsuid']) == 0) {
    header('location:logout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recipe Recommendation Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet">
</head>
<body>
    <?php include_once('includes/header.php');?>
    <?php include_once('includes/sidebar.php');?>
    <section id="main-content">
        <section class="wrapper">
            <h1>Recipe Recommendation Dashboard</h1>
            <form action="recommendation_handler.php" method="post">
                <label>What do you want to eat?</label>
                <input type="text" name="query" required><br><br>
                
                <label>Preferred preparation time (minutes, between 10 to 60):</label>
                <input type="number" name="prep_time" min="10" max="60" required><br><br>
                
                <label>How many people to feed? (1 to 12):</label>
                <input type="number" name="num_people" min="1" max="12" required><br><br>
                
                <input type="submit" value="Get Recommendations" class="btn btn-primary">
            </form>
        </section>
    </section>
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
</body>
</html>
