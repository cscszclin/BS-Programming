<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=News', "news", "news", array(PDO::ATTR_PERSISTENT => true));
  if ($_POST['operation'] == "reset") {
  	$sql = "UPDATE userdata SET top = '$_POST[top]', social = '$_POST[social]', domestic = '$_POST[domestic]', international = '$_POST[international]', entertainment = '$_POST[entertainment]', sport = '$_POST[sport]', millitary = '$_POST[millitary]', technology = '$_POST[technology]', finance = '$_POST[finance]', fashion = '$_POST[fashion]' WHERE ID = '$_POST[username]'";
  	$conn -> exec ($sql);
    $url  =  "index.html" ;  
    echo " <script language = 'javascript' type = 'text/javascript' > ";  
    echo " window.location.href = '$url' ";  
    echo " </script> "; 
  }
  else {
    if ($_POST['username'] != '') {
    	$sql = "SELECT * FROM userdata WHERE ID = '$_POST[username]'";
    	$result = $conn -> query ($sql);
    	foreach ($result as $row) {
    		$newdata = $row[$_POST['engType']] + 5;
    	}
    	$sql = "UPDATE userdata SET " . $_POST['engType'] . "= '$newdata' WHERE ID = '$_POST[username]'";
    	$conn -> exec ($sql);
    }
    echo " <script language = 'javascript' type = 'text/javascript' > ";  
    echo "window.open = 'http://' + '";
    echo $_POST['url'];
    echo "';";
    echo " window.location.href = 'http://' + '";
    echo $_POST['url'];
    echo "'; </script> "; 
  }
}
catch (PDOException $e) {
  echo $e -> getMessage();
}
$conn = null;
echo "用户喜好更新成功，正在跳转回首页";
?>


