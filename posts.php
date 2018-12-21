


<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
 $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
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
$sql1 ="SELECT *  FROM posts ORDER BY created_at DESC";
                $statement = $connection->prepare($sql1);

                // izvrsavamo upit
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $posts = $statement->fetchAll();

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    // echo '<pre>';
                    // var_dump($posts);
                    // echo '</pre>';
?>
<?php
                foreach ($posts as $post){
            ?>
                <article class ="va-c-article">
                <header>
                            <h1><a class = "blog-post-title"href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h1>

                            <!-- zameniti  datum i ime sa pravim imenom i datumom blog post-a iz baze -->
                            <div class="va-c-article__meta"> <?php echo($post['created_at']) ?> by <?php echo($post['author']) ?></div>
                        </header>
                
                        <div>
                            <!-- zameniti ovaj privremeni (testni) text sa pravim sadrzajem blog post-a iz baze -->
                            <p> <?php echo($post['body']) ?></p>
                        </div>
                        
                    </article>
      
            <?php
                }
            ?>



           




