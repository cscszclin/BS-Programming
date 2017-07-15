<?php

try {
  //session_start();
  $conn = new PDO('mysql:host=localhost;dbname=News', "news", "news", array(PDO::ATTR_PERSISTENT => true));
  $sql = "SELECT * FROM UserData WHERE '$_POST[User_id]' = ID AND '$_POST[User_pass]' = Pass";
  $result = $conn -> query ($sql);
  $flag = 0;
  foreach ($result as $row) {
    $flag = 1;
  }
    if ($flag == 0) {
      echo " <script language = 'javascript' type = 'text/javascript' > ";  
      echo " window.location.href = 'login.html?message=Wrong ID or Password!'";  
      echo " </script> "; 
    }
    else {
  	  
      echo "<script>function setCookie(c_name,value,expiredays){var exdate=new Date();exdate.setDate(exdate.getDate()+expiredays);document.cookie=c_name+ \"=\" +escape(value)+((expiredays==null) ? \"\" : \";expires=\"+exdate.toGMTString())}</script>";
      echo "<script>setCookie('username','";
      echo $_POST[User_id];
      echo "',365)</script>";
      echo " <script language = 'javascript' type = 'text/javascript' > ";  
      echo " window.location.href = 'message.html?message=Log in finished, now back to home page!' ";  
      echo " </script> "; 
    }
}
catch (PDOException $e) {
  echo $e -> getMessage();
}
$conn = null;
?>


