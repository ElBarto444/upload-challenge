<?php

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtensions)))
    {
        $errors[] = "Veuillez selectionner une image de type 'jpg', 'jpeg', 'gif', 'webp' ou 'png'";
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
        $errors[] = "Votre image doit faire moins de 1Mo !";
    }
    
}

    if (empty($errors))
    {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        header('form.php');
    }

    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        
        <h1>Upload your file here my friend.</h1>
        <?php foreach ($errors as $error) : ?>
            <?= $error ?>
        <?php endforeach ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="imageUpload">Upload a profile image</label>
            <input type="file" name="avatar" id="imageUpload" />
            <button name="send">Send</button>
        </form>
    </main>
</body>

</html>