<?php

if (isset($_POST['submit'])) {
    
    //Access aux attributs de $_FILES
    /*echo "Nom : " . $name = $_FILES['fichier']['name'] . "<br>";
    
    echo "Type : " . $type = $_FILES['fichier']['type'] . "<br>";
    
    echo "Taille : " . $size = $_FILES['fichier']['size'] . "<br>";
    
    echo "Destination temporaire : " . $tmpLocation = $_FILES['fichier']['tmp_name'] . "<br>";
    
    echo "Erreur : " . $error = $_FILES['fichier']['error'] . "<br>"; */
    
    $name = $_FILES['fichier']['name'];
    $size = $_FILES['fichier']['size'];
    $tmpLocation = $_FILES['fichier']['tmp_name'];
    $error = $_FILES['fichier']['error'];
    
    $estAutorisé = array('pdf', 'jpg', 'jpeg', 'png');
    
    $tmpExtension = explode('.', $name);
    $fileExtension = strtolower(end($tmpExtension));
    
    if (in_array($fileExtension,$estAutorisé)) {
        if ($error === 0) {
           if ($size < 50000) {
               $newFileName = uniqid('',true) . "." . $fileExtension;
               $newDestination = "uploads/" . $newFileName;
               move_uploaded_file($tmpLocation, $newDestination);
               header("Location: fichier.php?uploadsuccess");
           } else {
               echo "Desolé, fichier trop volumineux ";
           } 
        } else {
            echo "Desolé, une erreur s'est produite ";
        }
    } else {
        echo "Desolé, extension non acceptée! ";
    }
    
}




