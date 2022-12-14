<?php 
    session_start();
    require('actions/questions/showAllQuestionsAction.php');

    function getppuser(){
        
        try{$bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', '');
        }catch(Exception $e){
            die('Une erreur a été trouvée : ' . $e->getMessage());
        }
        
        $getppuser = $bdd->prepare('SELECT img FROM users WHERE id = ?');
        $getppuser->execute(array($_SESSION['id']));
        $fetch = $getppuser->fetch();
        if($fetch)
        {
            $chemin = $fetch['img'];
            if(!empty($chemin))
            {
                echo $chemin;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>

    <div class="container">
    
        <form method="GET">

            <div class="form-group row">

                <div class="col-8">
                    <input type="search" name="search" class="form-control">
                </div>
                <div class="col-4">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </div>

            </div>
        </form>

        <br>

        <?php 
            while($question = $getAllQuestions->fetch()){
                ?>
                <div class="card">
                    <div class="card-header">
                        <a href="article.php?id=<?= $question['id']; ?>">
                            <?= $question['titre']; ?>
                        </a>
                    </div>
                    <div class="card-body">
                        <?= htmlentities($question['description']); ?>
                    </div>
                    <div class="card-footer">
                        Publié par <a href="profile.php?id=<?= $question['id_auteur']; ?>"><?= $question['pseudo_auteur']; ?><img src="<?php getppuser(); ?>" width="100px"></a> le <?= $question['date_publication']; ?>
                    </div>
                </div>
                <br>
                <?php
            }
        ?>

    </div>

</body>
</html>