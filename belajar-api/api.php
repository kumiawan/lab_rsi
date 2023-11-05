<?php

include 'koneksi.php';
header('Content-Type: application/json');

if(function_exists($_GET['function'])){
	$_GET['function']();
}else{
	echo "mampus";
}

// GET ALL User
function get_user(){
	global $koneksi;
	$query= $koneksi->query("SELECT * FROM user_detail");
	while ($row =mysqli_fetch_object($query))
	{
		$data[]=$row;
	}
	$response=array(
		'status'=>1,
		'message'=> 'Success',
		'data'=> $data
	);
	echo json_encode($response);
}

// FIND BY ID
function get_user_id(){

	global $koneksi;
	if(!empty($_GET["id"])){
		$id = $_GET["id"];
	}
	$query = "SELECT * FROM user_detail WHERE id= $id";
	$result = $koneksi->query($query);
	while($row = mysqli_fetch_object($result)){
		$data[]=$row;
	}
	if($data){
		$response=array(
			'status'=>1,
			'message'=> 'Success',
			'data'=> $data
		);
	}else{
		$response=array(
			'status'=>0,
			'message'=> 'No Data found'		
		);
	}
	echo json_encode($response);
}


// UPDATE 
function update_user()
{
	global $koneksi;
	if(!empty($_GET["id"])){
		$id = $_GET["id"];
		$email= $_GET["email"];
		$password= $_GET["password"];
		$name= $_GET["name"];
	}
	$query = "UPDATE user_detail SET user_email='$email',user_password='$password',user_fullname='$name' WHERE id=$id";
	if($result=mysqli_query($koneksi, $query)){
		if($result)
		{
			$response=array(
				'status'=>1,
				'message'=> 'Update success'		
			);
		}
		else
		{
			$response=array(
				'status'=>0,
				'message'=> 'Update fail'		
			);

		}
	}
	else
	{
		$response=array(
			'status'=>0,
			'message'=> 'Wrong Parameter',
			'data'=> $id,
			'query'=> $query		
		);

	}
	echo json_encode($response);
}

// DELETE
function delete_user()
{

	global $koneksi;
	$id = $_GET['id'];
	$query = "DELETE FROM user_detail WHERE id=$id";
	if(mysqli_query($koneksi, $query))
	{
		$response = array(
			'status'=>1,
			'message'=>'Delete success'
		);
	}
	else {
		$response = array(
			'status'=>0,
			'message'=>'Delete fail',
			'query'=>$query
		);

	}
	echo json_encode($response);

}
?>
