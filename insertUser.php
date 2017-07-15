<?php

try {
  $conn = new PDO('mysql:host=localhost;dbname=News', "news", "news", array(PDO::ATTR_PERSISTENT => true));
  $flag = 1;
  $sql = "SELECT * FROM userdata WHERE ID = '$_POST[User_id]'";
  $result = $conn -> query ($sql);
  foreach ($result as $row) {
  	$flag = 0;
  	echo " <script language = 'javascript' type = 'text/javascript' > ";  
	  echo " window.location.href = 'register.html?message=This ID exists!&id=";
    echo $_POST['User_id'];
    echo "&email=";
    echo $_POST['User_email'];  
	  echo "'</script> "; 
  }

  $sql = "SELECT * FROM userdata WHERE Email = '$_POST[User_email]'";
  $result = $conn -> query ($sql);
  foreach ($result as $row) {
  	$flag = 0;
  	echo " <script language = 'javascript' type = 'text/javascript' > ";  
	  echo " window.location.href = 'register.html?message=This Email exists!&id=";
    echo $_POST['User_id'];
    echo "&email=";
    echo $_POST['User_email'];    
	  echo "'</script> "; 
  }
  if ($flag == 1) {
  	$sql = "INSERT INTO userdata (ID, Pass, Email, top, social, domestic, international, entertainment, sport, millitary, technology, finance, fashion) VALUES ('$_POST[User_id]', '$_POST[User_pass]', '$_POST[User_email]', 30, 30, 30, 30, 30, 30, 30, 30, 30, 30)";
  	$conn -> exec ($sql);
  	echo " <script language = 'javascript' type = 'text/javascript' > ";  
	  echo " window.location.href = 'message.html?message=Resigter finished, now back to home page!' ";  
	  echo " </script> "; 
  }
  
}
catch (PDOException $e) {
  echo $e -> getMessage();
}

$conn = null;
echo "用户注册成功，正在跳转回首页";
echo $_SESSION[User];
$url  =  "index.html" ;  


?>


