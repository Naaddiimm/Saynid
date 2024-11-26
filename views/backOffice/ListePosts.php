<?php
include '../../controllers/PostC.php';
include '../../controllers/CommentC.php';
$PostC=new PostC();
$liste=$PostC->listPosts();
$commentC = new CommentC();
$listeComments = $commentC->listComments();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Blog</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
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
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
  </body>
</html>