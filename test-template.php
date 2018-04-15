<?php 

/*
Template Name: WPDD Test
*/

global $wpdb;

$error = array();



if( isset($_POST['submit_info']) ){
	$first_name 	= $_POST['fname'];
	$last_name 		= $_POST['lname'];
	$uname 			= $_POST['username'];
	$email 			= $_POST['email'];


	if( empty($first_name) ){
		$error['fname'] = "First name can'b be blank";
	}

	if( empty($last_name) ){
		$error['lname'] = "Last name can'b be blank";
	}

	if( empty($uname) ){
		$error['uname'] = "User Name can'b be blank";
	}

	if( empty($email) ){
		$error['email'] = "Email Address can'b be blank";
	}




	$error_num = count($error);

	echo $error_num;

	if($error_num === 0){

		$table = $wpdb->prefix."rostom";

		$insert_info = $wpdb->insert( 
			// table name
			$table, 

			// column names as a key + name field as a value 
			array(
				'fname'	=> $first_name,
				'lname'	=> $last_name,
				'username'	=> $uname,
				'email'	=> $email,
			), 
			
			// define the data type %s = String, %d = integer and %f = float
			array(
				'%s',
				'%s',
				'%s',
				'%s',

			)
		);

		if($insert_info){
			$sucss = "You are successful";
		}else{
			$fail = "Try again";
		}

	}
}





?>

<form action="" method="post">
	
	
	<table>
		<tr>
			<td><label for="fname">First Name</label></td>
			<td><input type="text" name="fname" id="fname"></td>
			<?php if(isset($error['fname'])){ echo "<td>".$error['fname']."</td>"; } ?>
		</tr>
		<tr>
			<td><label for="lname">Last Name</label></td>
			<td><input type="text" name="lname" id="lname"></td>
			<?php if(isset($error['lname'])){ echo "<td>".$error['lname']."</td>"; } ?>
		</tr>

		<tr>
			<td><label for="username">User Name</label></td>
			<td><input type="text" name="username" id="username"></td>
			<?php if(isset($error['uname'])){ echo "<td>".$error['uname']."</td>"; } ?>
		</tr>

		<tr>
			<td><label for="email">Email</label></td>
			<td><input type="text" name="email" id="email"></td>
			<?php if(isset($error['email'])){ echo "<td>".$error['email']."</td>"; } ?>
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" value="Submit" name="submit_info"></td>
		</tr>
	</table>

</form>


<?php

if( isset($sucss) ){
	echo $sucss;
}else{
	echo $fail;
}



$infos = $wpdb->get_results("SELECT * FROM wp_rostom");

echo "<pre>";
	// print_r($infos);
echo "</pre>";

?>
<table border="1">
	<tr>	
		<th>Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>User Name</th>
		<th>Email Address</th>
		<th>Update Info</th>
	</tr>
	<?php foreach ($infos as $key => $value) { ?>
	<tr>	
		<td><?php echo $value->userId; ?></td>
		<td><?php echo $value->fname; ?></td>
		<td><?php echo $value->lname; ?></td>
		<td><?php echo $value->username; ?></td>
		<td><?php echo $value->email; ?></td>
		<td><a href="?edit=<?php echo $value->userId; ?>">Edit</a> <a href="#">Delete</a></td>
	</tr>
	<?php	} ?>

</table>



<?php 


if( isset($_GET['edit']) ){
	$edit_id = $_GET['edit'];

	$view_info = $wpdb->get_results("SELECT * FROM wp_rostom WHERE userId=$edit_id");
	
?>


<form action="" method="post">
	
	<?php foreach ($view_info as $value) { ?>
	<table>
		<tr>
			<td><label for="fname">First Name</label></td>
			<td><input type="text" name="updatefname" value="<?php echo $value->fname; ?>" id="fname"></td>
			
		</tr>
		<tr>
			<td><label for="lname">Last Name</label></td>
			<td><input type="text" name="updatelname" value="<?php echo $value->lname; ?>" id="lname"></td>
			
		</tr>

		<tr>
			<td><label for="username">User Name</label></td>
			<td><input type="text" name="updateusername" value="<?php echo $value->username; ?>" id="username"></td>
			
		</tr>

		<tr>
			<td><label for="email">Email</label></td>
			<td><input type="text" name="updateemail" value="<?php echo $value->email; ?>" id="email"></td>
			
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" value="Submit" name="update_info"></td>
		</tr>
	</table>
	<?php } ?>

</form>



<?php }

	




