<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify"; // VIVIFY
    $dbname = "blog";
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<?php
        if (isset($_POST['submit'])) {

            try {
                $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                
                $new_post = array(
                    "title" => $_POST['title'],
                    "body"  => $_POST['body'],
                    "author" => $_POST['author'],
                    "created_at"=>$_POST['vreme']
        );

                $sql = sprintf(
                        "INSERT INTO %s (%s) values (%s)",
                        "posts",
                        implode(", ", array_keys($new_post)),
                        ":" . implode(", :", array_keys($new_post))
                );
                header('Location: glavniIndex.php');
                $statement = $connection->prepare($sql);
                $statement->execute($new_post);
            } catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }
    ?>
<?php include 'header.php';?>
    <main role="main" class="container">

            <div class="row">

<div class="col-sm-8 blog-main">

    <div class="blog-post">

        <form method="post" name="form" onsubmit="return proveraUnetihPodataka(['title','body','author','vreme'],'form')">

            <label style="display: block" for="title">Title</label>
            <input type="text" name="title" id="title">

            <label style="display: block" for="body">Content</label>
            <textarea name="body" id="body" rows="4" cols="50"></textarea>
            
            <label style="display: block" for="vreme">Date</label>
            <input type="text" name="vreme" id="vreme">

            <label style="display: block" for="author">Author</label>
            <input type="text" name="author" id="author">

        
            <input style="display: block" class="btn btn-default" type="submit" name="submit" value="Submit">

        </form>
    </div>
</div>

</div>
<?php include 'footer.php';?>
</body>
</html>

  

<script>
function proveraUnetihPodataka(aaa, forma) { // 
	let validateFalse = [];
	aaa.forEach(polje => {
		let newpolje = document.forms[forma][polje].value;
	    if (newpolje == "" || newpolje == null || newpolje == 'undefined') {
	    	validateFalse.push(polje);
	    
	    }
	});

	if (validateFalse.length) {
		alert("Polja " + validateFalse[0] + " su obavezna!");

		return false;
	}

    return true;
};
</script>





