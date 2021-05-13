<?php 



	include_once('phpmailer/class.phpmailer.php');

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$phoneNumber = $_POST['phoneNumber'];
	header('Content-Type: application/json');
	if ($name === ''){
	print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
	exit();
	}
	if ($email === ''){
	print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
	exit();
	} else {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
	exit();
	}
	}
	if ($phoneNumber === ''){
	print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
	exit();
	}
	if ($message === ''){
	print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
	exit();
	}

	$mail = new PHPMailer();
    //$mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->Host = 'ssl://smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'nkccsm@gmail.com';
    $mail->Password = 'nkccsm123456';
    $mail->SMTPSecure = null; 

    $mail->AddAddress("bdsf124@gmail.com");  
    // $mail->AddAddress("shekjasola@gmail.com");  

    $mail->From = 'nkccsm@gmail.com';
    $mail->FromName = "xpress gati";
    $mail->Subject = "Query";
    $mail->MsgHTML($message);

  	if(!$mail->Send()) {
	    $error = [
	      'status' => 'unsuccess',
	      'error_field' => '',
	      'error' => 'Something went wrong.'
	    ];
    	echo json_encode($error);die;
  	} else {
    	$success_response = [
      	'status' => 'success',
      	'message' => 'We will get in touch with you.'
    	];
    	echo json_encode($success_response);die;
  	}
?>