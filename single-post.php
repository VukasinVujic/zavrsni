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



<!doctype html>
    <html lang="en">
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <link rel="shortcut icon" href="favicon.ico">
        <title>Vivify Academy Blog - Homepage</title>
    
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="styles/styles2.css">
            
    </head>
    <body class="va-l-page va-l-page--single">
    
    <?php include 'header.php'; ?>


    <div class="va-l-container">
            <main class="va-l-page-content">
    
                <?php
                
                    if (isset($_GET['post_id'])) {
                        // pripremamo upit
                        $sql =
                        "SELECT *
                        FROM posts
                        WHERE posts.id = {$_GET['post_id']}";
                        $statement = $connection->prepare($sql);
    
                        // izvrsavamo upit
                        $statement->execute();
    
                        // zelimo da se rezultat vrati kao asocijativni niz.
                        // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
    
                        // punimo promenjivu sa rezultatom upita
                        $singlePost = $statement->fetch();
    
                        // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                            echo '<pre>';
                            // var_dump($singlePost);
                            echo '</pre>';
    
                ?>

            <article class="va-c-article">
                            <header>
                                <h1 a class = "blog-post-title"><?php echo $singlePost['title'] ?></h1>
                                <!-- zameniti  datum i ime sa pravim imenom i datumom blog post-a iz baze -->
                                <div class="va-c-article__meta"><?php echo $singlePost['created_at'] ?> by <?php echo $singlePost['author'] ?></div>
                            </header>

                            <!-- zameniti ovaj privremeni (testni) text sa pravim sadrzajem blog post-a iz baze -->
                            <div>
                                <?php echo $singlePost['body'] ?>
                            </div>
                            <!-- <a href="delete-post.php?id=<?php echo $singlePost['id']; ?>"><button onclick="promptFunction()" class="btn btn-default">Delete this post</button></a> -->
                            <a href="delete-post.php?id=<?php echo $singlePost['id']; ?>"><button onclick="return confirm('Do you really want to delete this post?')" class="btn btn-default">Delete this post</button></a>
                             <br>                               
                            <br>
                            <br>


                            <?php include 'add-comment.php';?>

                            <button id="showhide" class="btn btn-default " >Hide comments</button>
                            
                            <div class="comments">
                                <h3>comments</h3> 
                                
                                <?php
                                $sqlComments =

                                    "SELECT * from posts JOIN comments  ON comments.post_id = posts.id WHERE comments.post_id = {$_GET['post_id']}";
                              
                                    $statement = $connection->prepare($sqlComments);
                                    
                                $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_ASSOC);

                                $comments = $statement->fetchAll();
    
                                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                                    echo '<pre>';
                                    // var_dump($comments );
                                    echo '</pre>';
    
                                    foreach ($comments as $comment) {
                                ?>

                                    <li class="comment_item">

                                    <?php echo("Autor je: ".$comment['author']."<br>"); ?>

                                    <?php echo("Komentar je: ".$comment['text']); ?>
                                    </li>

                                    <a href="delete-comment.php?id=<?php echo($comment['id']); ?>&post_id=<?php echo($comment['post_id']); ?>"  class="btn btn-default" >Brisanje komentara</a>

                                    <hr>
                                    <?php } ?>
                            </div>
                        </article> 
                                        
                        <?php
                    } else {
                        echo('post_id nije prosledjen kroz $_GET');
                    }
                ?>                  

            </main>
        </div>

        <?php include 'footer.php'; ?>

                      

        </body>
        </html>

<!-- 
        <script>
    var stanje = "open";
    document.querySelector('#showhide').addEventListener('click', function () {
        console.log(stanje);
        if(stanje == "open"){
            document.querySelector('.comments').style.display = "none" ;
            document.querySelector('#showhide').innerHTML = "Show comments";
            stanje = "closed";
    } else  {
        document.querySelector('.comments').style.display = "block" ;
        document.querySelector('#showhide').innerHTML = "Hide comments";
        stanje = "open";
        }
    });
 </script> -->

<!-- <script>

//  function promtFunction(){
//     var odluka = promt("Do you want to delete this post?");
//     if(odluka !== null){
//         confirm("Do you really want to delete this postsdfds");
//     }
//     return odluka;
//  }


 </script>
 -->

 <script>

    function promptFunction(){
        var resenje =false;
        if(confirm("Do you want really want to delete this posts?")){
            resenje =true;
        } else {
            resenje = false;
        }
        console.log(resenje);
    }

 </script>


   


