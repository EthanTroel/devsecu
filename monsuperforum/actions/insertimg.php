<?php
// var_dump($_FILES);
require('database.php');
if(!empty($_FILES)){
    $img = $_FILES['img'];
    $ext = strtolower(substr($img['name'],-3));
    $chemin = "img/".$img['name'];


    $allow_ext = array('jpg','png','gif');
    if(in_array($ext,$allow_ext)){
        move_uploaded_file($img['tmp_name'], "img/".$img['name']);
      $insertimg = $bdd->prepare("UPDATE users SET img = ? WHERE id = ?");
      $insertimg->execute(array($chemin, $_SESSION['id']));
      while($nomImage = $insertimg->fetch() );
      echo('Image ajouté avec succès');
    }else{
      $erreur = "Votre fichier n'est pas une image ou l'extension n'est pas prise en charge.";
    }
  
}