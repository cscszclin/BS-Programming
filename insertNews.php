<?php

try {
  $conn = new PDO('mysql:host=localhost;dbname=News', "news", "news", array(PDO::ATTR_PERSISTENT => true));
  $conn -> exec ("INSERT INTO news (_key, title, date, category, authorName, url, picture) VALUES ('$_POST[_key]', '$_POST[title]', '$_POST[date]', '$_POST[category]', '$_POST[authorName]', '$_POST[url]', '$_POST[picture]')");
}
catch (PDOException $e) {
  echo $e -> getMessage();
}
$conn = null;
?>


