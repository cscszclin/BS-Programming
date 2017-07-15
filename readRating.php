<?php

try {
  $conn = new PDO('mysql:host=localhost;dbname=News', "news", "news", array(PDO::ATTR_PERSISTENT => true));
  $sql = "SELECT * FROM userdata WHERE ID = '$_POST[username]'";
  $result = $conn -> query ($sql);

  $charaType = array('头条', '社会', '国内', '国际', '娱乐', '体育', '军事', '科技', '财经', '时尚');
  $engType = array('top', 'social', 'domestic', 'international', 'entertainment', 'sport', 'millitary', 'technology', 'finance', 'fashion');


  foreach ($result as $row) {
    echo "欢迎回来，";
    echo $_POST['username'];
    echo "<br><br>";
    for ($i = 0; $i < 10; $i = $i + 1) {
      echo "<table id = \"";
      echo $engType[i];
      echo "Rating\"><tr><td></td>";
      echo $charaType[i];
      echo " : </td>";
      $count = 0;
      for ($j = 0; $j < $row[$engType[i]] / 30; $j = $j + 1) {
        echo "<td>★</td>";
        $count = $count + 1;
      }
      while ($count < 5) {
        echo "<td>☆</td>";
        $count = $count + 1;
      }
      echo "</tr></table>";
    }
    echo "<br><button type = \"button\" onclick = \"resetRating()\">点击提交</button>";
  }
}
catch (PDOException $e) {
  echo $e -> getMessage();
}

$conn = null;
echo "用户喜好更新成功，正在跳转回首页";

$url  =  "index.html" ;  
//echo " <script language = 'javascript' type = 'text/javascript' > ";  
//echo " window.location.href = '$url' ";  
//echo " </script> "; 

?>


