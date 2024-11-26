<?php
include_once '../../controllers/CommentC.php';
include "../../controllers/PostC.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_post = isset($_POST['ID_post']) ? $_POST['ID_post'] : null;
    $Contenu = $_POST['Contenu'];
    $Pseudo = $_POST['Pseudo'];
    $DatePublication = new DateTime();

    $comment = new Comment(NULL, $ID_post, $Contenu, $Pseudo, $DatePublication, 0);
    
    $commentC = new CommentC();
    $commentC->addComment($comment);

    $postC = new PostC();
    $postC->incrementCommentCount($ID_post);

    header('Location: post_details.php?id=' . $ID_post);
    exit();
}
?>



<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
</head>
<body>
    <h2>Ajouter un commentaire</h2>
    <form action="AddComment.php?ID_post=<?= $post['ID_post']; ?>" method="post">
        <input type="hidden" name="ID_post" value="<?php echo isset($_GET['ID_post']) ? $_GET['ID_post'] : ''; ?>">
        <label for="Pseudo">Pseudo :</label><br>
        <input type="text" id="Pseudo" name="Pseudo"><br><br>
        <label for="Contenu">Contenu :</label><br>
        <textarea id="Contenu" name="Contenu" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
