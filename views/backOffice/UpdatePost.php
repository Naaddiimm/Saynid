<?php
// Inclure les fichiers nécessaires
include_once 'C:/xampp/htdocs/projet/config/config.php';
include 'C:/xampp/htdocs/projet/controllers/PostC.php';

// Récupération de l'ID du post depuis l'URL (ID_post)
if (isset($_GET['ID_post']) && !empty($_GET['ID_post'])) {
    $id = $_GET['ID_post']; // Utilisation de 'ID_post' qui est passé dans l'URL
    $postC = new PostC();
    $post = $postC->getPostById($id); // Récupérer le post à partir de l'ID
} else {
    // Si aucun ID n'est passé, afficher un message d'erreur
    echo "Aucun post trouvé.";
    exit;
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['Titre'];
    $contenu = $_POST['Contenu'];
    $auteur = $_POST['Auteur'];
    $datePublication = new DateTime($_POST['Date_Publication']); // Format de la date
    $tags = $_POST['Tags'];
    $likes = $_POST['Likes'];
    $dislikes = $_POST['Dislikes'];
    $commentaires = $_POST['Commentaires'];
    $image = $_POST['Image'];

    // Créer un objet Post avec les nouvelles valeurs
    $updatedPost = new Post($id, $titre, $contenu, $auteur, $datePublication, $tags, $likes, $dislikes, $commentaires, $image);
    
    // Appeler la méthode pour mettre à jour le post
    $postC->UpdatePost($updatedPost, $id);
    
    // Rediriger vers une autre page après la mise à jour, par exemple la page de détails du post
    header("Location: homeAdmin.php?ID_post=$id");
    exit();
}

?>

<!-- HTML: Formulaire de mise à jour -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour le post</title>
</head>
<body>
    <h1>Modifier le Post</h1>
    <form method="POST" action="UpdatePost.php?ID_post=<?php echo $post->getid_B(); ?>">
        <label for="Titre">Titre:</label>
        <input type="text" id="Titre" name="Titre" value="<?php echo $post->getTitre(); ?>" required><br><br>
        
        <label for="Contenu">Contenu:</label>
        <textarea id="Contenu" name="Contenu" required><?php echo $post->getContenu(); ?></textarea><br><br>
        
        <label for="Auteur">Auteur:</label>
        <input type="text" id="Auteur" name="Auteur" value="<?php echo $post->getAuteur(); ?>" required><br><br>
        
        <label for="Date_Publication">Date de publication:</label>
        <input type="date" id="Date_Publication" name="Date_Publication" value="<?php echo $post->getDate_Publication()->format('Y-m-d'); ?>" required><br><br>
        
        <label for="Tags">Tags:</label>
        <input type="text" id="Tags" name="Tags" value="<?php echo $post->getTags(); ?>" required><br><br>
        
        <label for="Likes">Likes:</label>
        <input type="number" id="Likes" name="Likes" value="<?php echo $post->getLikes(); ?>" required><br><br>
        
        <label for="Dislikes">Dislikes:</label>
        <input type="number" id="Dislikes" name="Dislikes" value="<?php echo $post->getDislikes(); ?>" required><br><br>
        
        <label for="Commentaires">Commentaires:</label>
        <input type="number" id="Commentaires" name="Commentaires" value="<?php echo $post->getCommentaires(); ?>" required><br><br>
        
        <label for="Image">Image URL:</label>
        <input type="text" id="Image" name="Image" value="<?php echo $post->getImage(); ?>"><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
