<?php

    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify"; // VIVIFY
    $dbname = "blog";

?>

<?php
if (isset($_GET["id"])) {
  try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  
    $id = $_GET["id"];

    $sql1 = "DELETE FROM comments WHERE post_id = :id";
    $statement = $connection->prepare($sql1);
    $statement->bindValue(':id', $id);
    $statement->execute();


    $sql = "DELETE FROM posts WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

	header("Location: index.php");

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}


?>