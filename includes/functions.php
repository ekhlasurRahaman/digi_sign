<?php
function redirect_to($new_location) {
	header("Location: " . $new_location);
	exit;
}
//========================================
function mysql_prep($string){
global $connection;
$escaped_string = mysqli_real_escape_string($connection, $string);
return $escaped_string;	
	
}

//==============================================

function confirm_query($public_set){
	if(!$public_set){
		die("Database query failed.");
	}
}
//================================================================

function form_errors_signup($errors=array()) {
	$output = "";
	if (!empty($errors)) {
	  foreach ($errors as $key => $error) {
	    $output .= "<li>{$error}</li>";
	  }
	}
	return $output;
}
//================================================
function find_all_admins() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM admin ";
		$query .= "ORDER BY username ASC";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		return $admin_set;
	} 


//=============================================================

function password_encrypt($password){
	$hash_format = "$2y$10$";  //Tells PHP to use Blowfish with a cost of 10
	$salt_length = 22;         //Blowfish salts should be 22-characters or more
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
}

//====================================================
function generate_salt($length){
//not 100% unique, not 100% random , but good enough for a salt
//MD5 returns 32 characters
$unique_random_string = md5(uniqid(mt_rand(),true));
//Valid character for a salt are [a-zA-Z0-9./]
$base64_string = base64_encode($unique_random_string);

// But not  '+' which is valid in base64 encoding
$modified_base64_string = str_replace('+', '.', $base64_string);

//Truncate string to the correct length
$salt = substr($modified_base64_string, 0, $length);

return $salt; 
	
}

//=======================================================
function password_check($password, $existing_hash){
	$hash = crypt($password, $existing_hash);
	if($hash === $existing_hash){
		return true;
	}else{
		return false;
	}
}
//==============================================
function find_public_by_vein_data($vein_data){
	global $connection;
	//$safe_username = mysqli_real_escape_string($connection, $username);
	$query = "select* ";
	$query .= "from client_info ";
	$query .= "where vein_data = '{$vein_data}' ";
	$query .= "limit 1";
	$public_set = mysqli_query($connection, $query);
	confirm_query($public_set);
	if($public = mysqli_fetch_assoc($public_set)){
		
	return $public;	
	}else{
	return null;
	}	
}


//===========================================================

function find_public_info_by_vein_data($vein_data){
	global $connection;
		
		$query = "select* ";
		$query .= "from public_info ";
		$query .= "where vein_data = '{$vein_data}' ";
		$query .= "limit 1";
		$public_set = mysqli_query($connection, $query);
		confirm_query($public_set);
		if($public = mysqli_fetch_assoc($public_set)){
	       return $public;	
	    }else{
	      return null;
	    }
}


//=======================================================

function find_admin_by_user_name($user_name){
	global $connection;
	//$safe_username = mysqli_real_escape_string($connection, $user_name);
	$query = "select* ";
	$query .= "from admin_info ";
	$query .= "where user_name = '{$user_name}' ";
	$query .= "limit 1";
	$admin_set = mysqli_query($connection, $query);
	confirm_query($admin_set);
	if($admin = mysqli_fetch_assoc($admin_set)){
	return $admin;	
	}else{
	return null;
	}	
}



//=======================================================

function find_receiver_by_vein_data_and_otk($vein_data, $receiver_otk){
	global $connection;
	//$safe_username = mysqli_real_escape_string($connection, $user_name);
	$query = "select* ";
	$query .= "from public_file ";
	$query .= "where receiver_vein = '{$vein_data}' and otk = {$receiver_otk}";
	$receiver_set = mysqli_query($connection, $query);
	confirm_query($receiver_set);
	if($receiver = mysqli_fetch_assoc($receiver_set)){
	return $receiver;	
	}else{
	return null;
	}	
}

//=====================================================

function find_client_signature($vein_data){
	global $connection;
	$query  = "SELECT * ";
	$query .= "FROM client_signature ";
	$query .= "where vein_data = '{$vein_data}'";
	$signature_set = mysqli_query($connection, $query);
	confirm_query($signature_set);
	if($signature = mysqli_fetch_assoc($signature_set)){
	return 1;	
	}else{
	return 0;
	}
}


//=====================================================
function attempt_login_public($vein_data){
	$public = find_public_by_vein_data($vein_data);
	if($public){
	//public found
	$public_vein_data= $public["vein_data"];
	if($vein_data == $public_vein_data){
		
		global $connection;
		//$safe_username = mysqli_real_escape_string($connection, $username);
		$query = "select* ";
		$query .= "from public_info ";
		$query .= "where vein_data = '{$vein_data}' ";
		$query .= "limit 1";
		$public_set = mysqli_query($connection, $query);
		confirm_query($public_set);
		$public_data = mysqli_fetch_assoc($public_set);
		
		return $public_data;
	}	else{
		//password does not matches
		return false;
	}
	}else{
		//admin not found
		return false;
	}
}


//=====================================================

function attempt_login_admin($vein_data, $user_name){
	$admin = find_admin_by_user_name($user_name);
	if($admin){
	//public found
	$existing_hash = $admin["vein_data"];
	if(password_check($vein_data, $existing_hash)){
		//password matches	
		return $admin;
	}	else{
		//password does not matches
		return false;
	}
	}else{
		//admin not found
		return false;
	}
}

//=====================================================

function file_verification($vein_data, $receiver_otk, $combine_key){
	$receiver = find_receiver_by_vein_data_and_otk($vein_data, $receiver_otk);
	if($receiver){
	//public found
	$existing_hash_combine_key = $receiver["combine_key"];
	if(password_check($combine_key, $existing_hash_combine_key)){
		//password matches	
		return $receiver;
	}	else{
		//password does not matches
		return false;
	}
	}else{
		//receiver not found
		return false;
	}
}

//===============================================
function logged_in(){
	return isset($_SESSION["admin_id"]);
}
//============================================

function confirm_logged_in(){
	if(!logged_in()){
	redirect_to("login.php");
    }
}


//=======================================================
function find_admin_by_id($selected_admin_id){
	global $connection;
	$safe_admin_id = mysqli_real_escape_string($connection, $selected_admin_id);
	$query = "select* ";
	$query .= "from admin ";
	$query .= "where id = {$safe_admin_id} ";
	$query .= "limit 1";
	$admin_set = mysqli_query($connection, $query);
	confirm_query($admin_set);
	if($admin = mysqli_fetch_assoc($admin_set)){
	return $admin;	
	}else{
	return null;
	}	
}


//=======================================================

function random_public_key(){
	$unique_random_string = md5(uniqid(mt_rand(),true));
    $base64_string = base64_encode($unique_random_string);//base64_string
	return $base64_string;
}

//===============================================================

function one_time_key(){
	$min = 10000;
    $max = 100000;
    $otk = rand ( $min , $max );
	return $otk;
}
function registered_contact($email){
	global $connection;
	$query = "select* ";
	$query .= "from client_info ";
	$query .= "where email = '{$email}' ";
	$registered_client_set = mysqli_query($connection, $query);
	confirm_query($registered_client_set);
	$found_client = mysqli_fetch_assoc($registered_client_set);
	if(empty($found_client)){
		$status = 'Unregistered';
		return $status;
	}else{
		$status = 'Registered';
		return $status;
	}
}

    function delete_contact($vein_data, $email){
			global $connection;
			$query = "delete ";
			$query .= "from contact ";
			$query .= "where vein_data = '{$vein_data}' and email = '{$email}' ";
			$contact_set = mysqli_query($connection, $query);
			confirm_query($contact_set);
			return;
		}

function find_all_contact($vein_data){
	global $connection;
	$query = "select* ";
	$query .= "from contact ";
	$query .= "where vein_data = '{$vein_data}' ";
	$contact_set = mysqli_query($connection, $query);
	confirm_query($contact_set);
	return $contact_set;
}


function contact_table($vein_data){
	$output = "";
	$all_contact = find_all_contact($vein_data);
	while($found_client = mysqli_fetch_assoc($all_contact)){
	$vein_data = $found_client["vein_data"];
	$email = $found_client["email"];
	$output .= "<tr>";
	$output .= "<td>";
	$output .= htmlentities($found_client["name"]);
	$output .= "</td>";
	$output .= "<td>";
	$output .= htmlentities($found_client["email"]);
	$output .= "</td>";
	$output .= "<td>";
	$output .= htmlentities($found_client["status"]);
	$output .= "</td>";
	$output .= "<td class = \"text-center\">";
	$output .= "<a class = \"btn btn-danger btn-xs\" name=\"delete\" href=\"delete_contact.php?email=$email & vein_data=$vein_data\">";
	$output .= "<span class = \" glyphicon glyphicon-trash\"></span> Delete</button></td>";
	$output .= "</tr>";	 
	}
	mysqli_free_result($all_contact);
	return $output;
}
?>