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
    $postId = $_POST['post_neki_id'];
    $ime = ($_POST['ime']);
    $text = ($_POST['komentar']);
    var_dump($postId);
     
    $sql_add_comment = "INSERT INTO comments (author, text, post_id) VALUES ('$ime', '$text'," . intval($postId) . ");";

    $statement=$connection->prepare($sql_add_comment);
    $statement->execute();

$referer = $_SERVER['HTTP_REFERER']; // kada se doda komentar on reload-uje
header("Location: $referer");       
?>



