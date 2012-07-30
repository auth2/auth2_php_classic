<?php
  function check_user($username, $password)
  {
     return TRUE;
  }

  session_start();
  $AUTH2_SEND_KEY_R1_URL= 'https://auth2.com/api/r1/sendkey/';
  $api_key = '<your api key here>';
  $api_secret = '<your api secret here>';
  //set phone numbers here - probably from database
  $phone_0 = '000';
  $phone_1 = '000';
  $phone_2 = '0000';
     
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if(!check_user($username, $password))
  {
    die("Username/Password did not match.");
  }
  
  $key = rand(10000,99999);

  $_SESSION['TWO_FA_KEY']=$key;

  $post_data = "api_key=$api_key&api_secret=$api_secret&phone_0=$phone_0&phone_1=$phone_1&phone_2=$phone_2&key=$key";
  
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $AUTH2_SEND_KEY_R1_URL);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ; 
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_data);
  $resp = curl_exec ($ch);   
  curl_close ($ch);

  //[{"call_id_guid": "33a64d3c-59a2-4de6-a09b-8055f5fa0f58", "status": "Pending", "api_key": "b5746fba-7d12-41d0-99bd-afcfbd3e6039", "valid":"true"}]
  //echo "resp=$resp";
?>

<html>
<head>
  <style type='text/css'>
    label{display:Block}
    input{display:Block}
    .loginbox{width:300px}
  </style>
</head>
<body>
<div class='loginbox'>
<form id='login2' action='login2.php' method='post' accept-charset='UTF-8'>
  <fieldset>
    <legend>Login</legend>
    <label for='key' >Key:</label>
    <input type='text' name='key' id='key'  maxlength="50" />
    <input type='submit' name='Submit' value='Submit' />
  </fieldset>
</form>
</div>
</body>
</html>
