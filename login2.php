<?php
  session_start();
  $key = trim($_POST['key']);  
  $session_key = $_SESSION['TWO_FA_KEY'];
  if(strlen($key)>=2 && $key == $session_key)
  {
    $_SESSION['login_ok']=TRUE;
    echo "Login OK";
    exit;
  }
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



