<?php include_once('partials/header.php');?>
<?php include 'partials/navigation.php';?>
<?php 

if(!empty($_POST)){

       $username = $_POST['username']; 
       $password = $_POST['password'];
       $errors = loginUser($username, $password);

}
?>

<!--Page Content for Login-->

    <div class="container">
	<h2>Login</h2>
        <?php if ( ! empty( $errors ) ) : ?>
     <div class="errors">
       <p class="bg-danger"><?php echo implode( '</p><p class="bg-danger">', $errors ); ?></p>
     </div><?php endif; ?>
	<div class="row">
	  <div class="col-sm-6">
	      <form method="post" action="index.php" enctype="multipart/form-data">
		  <div class="form-group" id="loginDiv">
		    <label>Username</label>
		    <input type="text" class="form-control" id="username" name ="username" placeholder="Username">
		  </div>
		  <div class="form-group" id="lastNameDiv">
		    <label>Password</label>
		    <input type="password" class="form-control" id="password" name= "password" placeholder="password">
		  </div>
		  <button type="submit" class="btn btn-success">Login</button>
	      </form>
	 </div>
	</div>
    </div><!--end container -->

<!--end of Page content-->





<?php include_once('partials/footer.php');?>

