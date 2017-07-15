<?php

try {
  $conn = new PDO('mysql:host=localhost;dbname=News', "news", "news", array(PDO::ATTR_PERSISTENT => true));
  if ($_POST[type] == '') {
    
    if($_POST[username] == "") {
      $result = $conn -> query ("SELECT * FROM news ORDER BY date DESC");
    }
    else {
      $preference = $conn -> query ("SELECT * FROM userdata WHERE ID = '$_POST[username]'");
      foreach ($preference as $userdata) {
        $sum = $userdata['top'] + $userdata['social'] + $userdata['domestic'] + $userdata['international'] + $userdata['entertainment'] + $userdata['sport'] + $userdata['millitary'] + $userdata['technology'] + $userdata['finance'] + $userdata['fashion'];
      }
      $charaType = array('头条', '社会', '国内', '国际', '娱乐', '体育', '军事', '科技', '财经', '时尚');
      $engType = array('top', 'social', 'domestic', 'international', 'entertainment', 'sport', 'millitary', 'technology', 'finance', 'fashion');

      for ($x = 0; $x < 10; $x++) {
        $i = 0;
        $result = $conn -> query ("SELECT * FROM news WHERE category = '$charaType[$x]' ORDER BY date DESC");
        foreach ($result as $row) {
          $i = $i + 1;
          if ($i >= $userdata[$engType[$x]] / $sum * 30) {
            break;
          }
          echo "<h3><a href = \"JavaScript:modifyRating ('";
          echo $row['category'];
          echo "','";
          echo substr ($row['url'], 7);
          echo "')\">";
          echo $row['title'];
          echo "</a></h3>";

          echo "<div class = \"news_meta\"><a> 作者: ";
          echo $row['authorName'];
          echo "</a> 发布时间: ";
          echo $row['date'];
          echo " | 标签: ";
          echo $row['category'];
          echo "</div><br>";

          echo "<div class = \"image_wrapper\"><img src = ";
          echo $row['picture'];
          echo " width = \"600px\"/></div>";
          echo "<br><br>";
          
        }
      } 
      
      $result = NULL;
    }
  } 
  else {
    $result = $conn -> query ("SELECT * FROM news WHERE category = '$_POST[type]' ORDER BY date DESC");
  }
  //echo "this is result";
  if ($result == NULL) {
  	echo "以上即为为您推荐的新闻！";
  }
  else {
    $i = 0;
    foreach ($result as $row) {
  	  echo "<h3><a href = \"JavaScript:modifyRating ('";
          echo $row['category'];
          echo "','";
          echo substr ($row['url'], 7);
          echo "')\">";
          echo $row['title'];
          echo "</a></h3>";

  	  echo "<div class = \"news_meta\"><a> 作者: ";
      echo $row['authorName'];
      echo "</a> 发布时间: ";
      echo $row['date'];
      echo " | 标签: ";
      echo $row['category'];
      echo "</div><br>";

  	  echo "<div class = \"image_wrapper\"><img src = ";
      echo $row['picture'];
      echo " width = \"600px\"/></div>";
      echo "<br><br>";
      $i = $i + 1;
      if ($i > 30) {
        break;
      }
    }
  }
}
catch (PDOException $e) {
  echo $e -> getMessage();
}
$conn = null;


?>


