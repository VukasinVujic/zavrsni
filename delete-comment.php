<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify"; // VIVIFY
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>
<?php 
    $post_id = $_POST['post_neki_id'];
	$idComment = ($_GET['id']);
	$idPost = ($_GET['post_id']);
    $sql_remove_comment = "DELETE FROM comments WHERE id='$idComment';";
    $statement=$connection->prepare($sql_remove_comment);
    $statement->execute();

$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
?>