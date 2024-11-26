<?php
include '../../controllers/PostC.php';
include '../../controllers/CommentC.php';

if(isset($_GET['id'])) {
    $postID = $_GET['id'];
    $postC = new PostC();
    $commentC = new CommentC();
    $postDetails = $postC->showPost($postID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $postDetails['Titre']; ?></title>
    <link rel="stylesheet" href="../view/css/post.css">
</head>
<body>
<button onclick="redirectToBlog()" class="back-btn">Retour</button>
    <div class="container">
        <img src="../Images/<?= $postDetails['Image']; ?>" class="post-image">
        <h1 class="post-title"><?= $postDetails['Titre']; ?></h1>
        <p class="post-content"><?= $postDetails['Contenu']; ?></p>
        <div class="post-info">
            <button class="like-btn" data-post-id="<?= $postDetails['ID_post']; ?>">Like</button>
            <button class="dislike-btn" data-post-id="<?= $postDetails['ID_post']; ?>">Dislike</button>
        </div>

        <div class="comment-section">
            <h2>Commentaires</h2>
            <?php
                $comments = $commentC->listCommentsByPost($postID);
                
                foreach ($comments as $comment) {
                    echo '<div class="comment">';
                    $commentText = $commentC->replaceWordsWithEmojis($comment['Contenu']);
                    $filteredComment = $commentC->filterBadWords($commentText);
                    echo '<p><strong>' . $comment['Pseudo'] . '</strong></p>';
                    echo '<p>' . $filteredComment . '</p>';
                    echo '<a href="DeleteComment.php?id=' . $comment['ID_Comment'] . '">Supprimer</a>';
                    echo '</div>';
                }
            ?>

<form action="AddComment.php" method="post" class="comment-form" onsubmit="return validateComment()">
    <input type="hidden" name="ID_post" value="<?= $postDetails['ID_post']; ?>">
    <label for="Pseudo">Pseudo :</label><br>
    <input type="text" id="Pseudo" name="Pseudo"><br><br>
    <label for="Contenu">Contenu :</label><br>
    <textarea id="Contenu" name="Contenu" rows="4" cols="50"></textarea><br>
    <input type="submit" value="Ajouter Commentaire">
</form>
        </div>
    </div>

    <script>
        function validateComment() {
            var pseudo = document.getElementById("Pseudo").value;
            var contenu = document.getElementById("Contenu").value;

            if (pseudo.trim() === "" || contenu.trim() === "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }
            return true;
        }
    </script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".like-btn, .dislike-btn").on("click", function() {
                var postID = $(this).data("post-id");
                var action = $(this).hasClass("like-btn") ? "like" : "dislike";

                $.ajax({
                    type: "POST",
                    url: "update_reaction.php",
                    data: { ID_post: postID, action: action },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $(".likes-count").text(response.likes);
                            $(".dislikes-count").text(response.dislikes);
                        } else {
                            alert("Une erreur s'est produite lors de la mise à jour des réactions.");
                        }
                    },
                    error: function() {
                        alert("Une erreur s'est produite lors de la requête AJAX.");
                    }
                });
            });
        });
    </script>
    <script>
    function redirectToBlog() {
        window.location.href = "blog.php";
    }
</script>
</body>
</html>

<?php
}
?>
