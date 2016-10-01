<?php

function __($text) {
  return htmlspecialchars($text, ENT_COMPAT);
}

function checked($value, $array) {//Checks to see if the submitted value is in the submitted array
  if ( in_array( $value, $array ) ) {
    echo 'checked="checked"';//makes sure that when the user returns to page2, the checkboxes are still checked//literally checks the boxes
  }
}

//----------------------------------------------------------------------------------------------------------------------------------------------

//==============================================================================================================================================
//=Add text form field dynamically using a php //function==============================================================================================
function text($name, $id, $label, $placeholder, $type = 'text'){?>

<div class="form-group">
    <label for="<?php echo $id ?>"><?php echo $label; ?></label>
    <input type="<?php echo $type ?>" name="<?php echo $name ?>" class="form-control" id="<?php echo $id ?>" placeholder="<?php echo $placeholder ?>" value="<?php echo isset($_SESSION[$name]) ? __($_SESSION[$name]) : ''; ?>">
</div>

<?php }

//==============================================================================================================================================
//=Add submit btn dynamically using a php function==============================================================================================
function submit($value = 'submit', $class = 'btn btn-primary') {?>
  <button type="submit" class="<?php echo $class; ?>"><?php echo $value; ?></button>
<?php }
//==============================================================================================================================================


//==============================================================================================================================================
//=Add checkbox dynamically using a php function=============================================================================================

function checkbox($name, $id, $label, $options = array()){?>
<div class='form-group'>
  <p><?php echo $label; ?></p>
  <?php foreach($options as $value => $title) : ?>
  <label class='checkbox-inline' for="<?php echo $id; ?>">
  <input type='checkbox' name="<?php echo $name; ?>[]" value="<?php echo $value; ?>" <?php isset($_SESSION['interests']) ? checked($value, $_SESSION['interests']) : '' ?>>
   <span class="checkbox-title"><?php echo $title; ?></span>
   <?php endforeach; ?>
</div>
<?php }
//=============================================================================================================================================

/*Notes
 makes sure that all checked items(each value) are stored within the isset($_SESSION['interests']) array if so then checked function is executed to make sure that thr checkboxes are still checked when the user returns to page2.
*/

// Connect to Database function ===============================================================================================================

function db_connect(){

 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 if($conn->connect_error){

	die("Connection failed: " . $conn->connect_error);

 }
	return $conn;

}
//----------------------------------------------------------------------------------------------------------------------------------------------
// Insert user inputed data into db
//----------------------------------------------------------------------------------------------------------------------------------------------
function insert($data = array()){

	//Connect to database
	$conn = db_connect();

	// Whitelist(prevent a hack) and convert to variables
	$name = $data['name'];
	$email = $data['email'];
	$interests = $data['interests'];
	$address = $data['address'];
	$city = $data['city'];
	$state = $data['state'];

  	// Serialize interests for now.You can't store an array in mySQL, that is why you need to serialize it first.
	$interests = serialize($interests);

  	// Prepare and bind
	$stmt = $conn->prepare("INSERT INTO userData(name, email, interests, address, city, state) VALUES(?, ?, ?, ?, ?, ?)");
	// add variables to the sql 'INSERT INTO' query
	$stmt->bind_param("ssssss", $name, $email, $interests, $address, $city, $state);
	//Execute SQL INSERT INTO query
	$insert = $stmt->execute();//get a response back which is stored as a variable called '$insert', either true or false is returned
	//Return status of the executed sql query
	if($insert){
	   return $conn->insert_id;//if true, it will give us the id of the last submitted row in the db. Then the id gets submitted to page 4
	}//end of if stmt
	
	return false;

}//end of insert function
//----------------------------------------------------------------------------------------------------------------------------------------------
// Show/Display data from db
//----------------------------------------------------------------------------------------------------------------------------------------------

function show_results($insert_id){

	//Connect to db
	$conn = db_connect();
	// Prepare and bind
	$stmt = $conn->prepare("SELECT name, email, interests, address, city, state FROM userData WHERE ID = ?");
	$stmt->bind_param("d", $insert_id);
	// Execute and bind result;
	$stmt->execute();
	//data that was retreived will be stored within the response variable
	$response = $stmt->get_result();
	//Extract the results
	$results = $response->fetch_array(MYSQLI_ASSOC);
	//this is sent back to page 4. this contains the data from the db that we queryed for
	return $results;

}

