<?php
require_once(__DIR__ . '/../../config/config.php'); 
require_once(__DIR__ . '/../../controllers/UserController.php');

// Démarrer la session si elle n'est pas active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}
include '../../controllers/PostC.php';
include '../../controllers/CommentC.php';
$PostC=new PostC();
$liste=$PostC->listPosts();
$commentC = new CommentC();
$listeComments = $commentC->listComments();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Barre latérale -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="saynid.png" alt="Logo" class="logo">
            <h3>Dashboard</h3>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#profile" onclick="showSection('profile')"><i class="fas fa-user-circle"></i> Profile</a></li>
                <li><a href="#cours" onclick="showSection('cours')"><i class="fas fa-book"></i> Cours</a></li>
                <li><a href="#panier" onclick="showSection('panier')"><i class="fas fa-shopping-cart"></i> Panier</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-pen"></i> Blog</a></li>
                <li><a href="#test" onclick="showSection('test')"><i class="fas fa-check-circle"></i> Test</a></li>
                <li><a href="#stage" onclick="showSection('stage')"><i class="fas fa-briefcase"></i> Stage</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="main-content">
        <header class="user-info">
            <span>Bienvenue, <b>username</b></span>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
        </header>

        <div class="content">
            <div id="profile-content" class="section-content">
                <h2>Profile</h2>
                <p>Gérez vos informations personnelles et vos préférences.</p>
            </div>
            <div id="cours-content" class="section-content">
                <h2>Cours</h2>
                <p>Accédez à vos cours et ressources pédagogiques.</p>
            </div>
            <div id="panier-content" class="section-content">
                <h2>Panier</h2>
                <p>Consultez et gérez vos achats ou abonnements.</p>
            </div>
            <div id="blog-content" class="section-content">
                <h2>Blog</h2>
                <p>Découvrez ou publiez des articles intéressants.</p>
                <div class="table-responsive">
            <h2>Liste des Posts</h2>
        <table class="table">
         <thead>
            <tr>
                <th>ID Post</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Auteur</th>
                <th>Date de publication</th>
                <th>Tags</th>
                <th>Likes</th>
                <th>Dislikes</th>
                <th>Commentaires</th>
                <th>Image</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <?php
            foreach($liste as $post){
            ?>
            <tbody>
            <tr>
                <td><?= $post['ID_post'];?></td>
                <td><?= $post['Titre'];?></td>
                <td><?= $post['Contenu'];?></td>
                <td><?= $post['Auteur'];?></td>
                <td><?= $post['Date_Publication'];?></td>
                <td><?= $post['Tags'];?></td>
                <td><?= $post['Likes'];?></td>
                <td><?= $post['Dislikes'];?></td>
                <td><?= $post['Commentaires'];?></td>
                <td><img src="../Images/<?=$post['Image'];?>" alt="Image du Post" width="100%"></td>

                <td><a href="UpdatePost.php?ID_post=<?= $post['ID_post']; ?>" class="lien2">Update</a></td>
                <td><a href="DeletePost.php?id=<?= $post['ID_post'];?> " class="lien2">Delete</a></td>
            </tr>
            </tbody>
            <?php }?>
            <td><a href="AddPost.php" class="lien2">Add</a></td>
            </table>
            <h2>Liste des Commentaires</h2>
        <table class="table">
         <thead>
            <tr>
                <th>ID Commentaire</th>
                <th>ID Post</th>
                <th>Contenu</th>
                <th>Auteur</th>
                <th>Date de publication</th>
                <th>Likes</th>
            </tr>
            </thead>
            <?php foreach($listeComments as $comment): ?>
            <tbody>
            <tr>
                <td><?= $comment['ID_Comment']; ?></td>
                <td><?= $comment['ID_post']; ?></td>
                <td><?= $comment['Contenu']; ?></td>
                <td><?= $comment['Pseudo']; ?></td>
                <td><?= $comment['Date_Publication']; ?></td>
                <td><?= $comment['Likes']; ?></td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="test-content" class="section-content">
                <h2>Test</h2>
                <p>Testez vos connaissances sur divers sujets.</p>
            </div>
            <div id="stage-content" class="section-content">
                <h2>Stage</h2>
                <p>Gérez vos opportunités de stage ou suivez leur progression.</p>
            </div>
        </div>
    </main>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => section.style.display = 'none');
            const selectedSection = document.getElementById(sectionId + '-content');
            if (selectedSection) selectedSection.style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('profile');
        });
    </script>
</body>
</html>
