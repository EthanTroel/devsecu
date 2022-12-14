<?php 
    session_start(); 
    require('actions/database.php');
    require('actions/users/showOneUsersProfileAction.php');
    require('actions/insertimg.php');
    function ifchemin()
    {
        try{$bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', '');
        }catch(Exception $e){
            die('Une erreur a été trouvée : ' . $e->getMessage());
        }
        
        $ifchemin = $bdd->prepare('SELECT img FROM users WHERE id = ?');
        $ifchemin->execute(array($_SESSION['id']));
        $fetch = $ifchemin->fetch();
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
        <?php 
            if(isset($errorMsg)){ echo $errorMsg; }

            if(isset($getHisQuestions)){

                ?>
                <div class="card">
                    <div class="card-body">
                        <h4><?= $user_pseudo; ?></h4>
                        <img src="<?php ifchemin(); ?>" width="100px">
                        <hr>
                        <p><?= $user_lastname . ' ' . $user_firstname; ?></p>
                        <form action="" method="POST" enctype="multipart/form-data">
                     <div class="input-group mb-3">
                     <?php if(isset($erreur)){ echo '<p>'.$erreur.'</p>'; } ?>
                    <label class="input-group-text" for="inputGroupFile01">Ajouter une image de profil</label>
                    <input type="file" class="form-control" name="img">
                    </div>
                    <button type="submit" class="btn btn-primary" name="validate">Mettre à jour</button>
                    </form>
                    </div>
                </div>
                <br>
                <?php
                while($question = $getHisQuestions->fetch()){ 
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <?= $question['titre']; ?>
                        </div>
                        <div class="card-body">
                            <?= $question['description']; ?>
                        </div>
                        <div class="card-footer">
                            Par <?= $question['pseudo_auteur']; ?> le <?= $question['date_publication'];  ?>
                        </div>
                    </div>
                    <br>
                    <?php
                }

            }
        ?>  
    </div>

</body>
</html>