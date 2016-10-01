<?php include_once('partials/header.php');?>
<?php include 'partials/navigation.php'; ?>


<!--Include PHP file header and navigation partials-->
    <?php 
		if(isset($_SESSION["UserID"])){

			session_destroy();

			echo "<div class='container'><h4>You have been logged out.</h4></div>";

		    }

	?>
   
<?php include_once('partials/footer.php');?>  
