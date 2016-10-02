<?php

session_start();

//print_r($_FILES);

$fileName = $_FILES['file']['name'];
$fileType = $_FILES['file']['type'];
$fileError = $_FILES['file']['error'];
$fileContent = file_get_contents($_FILES['file']['tmp_name']);

if($fileError == UPLOAD_ERR_OK){
    //Processes files here

    $image = new SplFileInfo(basename($_FILES['file']['name']));
    $extension = $image->getExtension();

    $uploaddir = '../assets/uploads/';
    $pathfile = uniqid() . '.' . $extension;
    $uploadfile = $uploaddir . $pathfile;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

        // CONNEXION BDD
        try
        {
            $bdd = new \PDO('mysql:host=XXX;dbname=XXX;charset=utf8','XXX','XXX');
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        $profilePicture = $pathfile;
        $pseudo = $_SESSION['user']['pseudo'];

        $req = $bdd->prepare('UPDATE tchatuser SET profilePicture = :profilePicture WHERE pseudo = :pseudo');
        $req->execute(
            array(
                'profilePicture' => $profilePicture,
                'pseudo' => $pseudo
            )
        );

        $_SESSION['user']['profilePicture'] = $profilePicture;

        echo "Success";
        return;

    }

} else {
    switch($fileError){
        case UPLOAD_ERR_INI_SIZE:
            $message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = 'Error: no terminó la acción de subir el archivo.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = 'Error: ningún archivo fue subido.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = 'Error: servidor no configurado para carga de archivos.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message= 'Error: posible falla al grabar el archivo.';
            break;
        case  UPLOAD_ERR_EXTENSION:
            $message = 'Error: carga de archivo no completada.';
            break;
        default: $message = 'Error: carga de archivo no completada.';
            break;
    }
    echo json_encode(array(
        'error' => true,
        'message' => $message
    ));
}