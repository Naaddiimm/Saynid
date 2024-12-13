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
    <style>
        /* Global Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f7fc;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Post Image */
.post-image {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 20px;
}

/* Post Title */
.post-title {
    font-size: 2rem;
    color: #004085;
    text-align: center;
    margin-bottom: 20px;
}

/* Post Content */
.post-content {
    font-size: 1rem;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
    text-align: justify;
}

/* Post Info */
.post-info {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 30px;
}

.like-btn,
.dislike-btn {
    background-color: #004085;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.like-btn:hover,
.dislike-btn:hover {
    background-color: #0062cc;
}

/* Back Button */
.back-btn {
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 20px;
    display: inline-block;
}

.back-btn:hover {
    background-color: #ff1a1a;
}

/* Comment Section */
.comment-section {
    margin-top: 30px;
}

.comment-section h2 {
    font-size: 1.8rem;
    color: #004085;
    margin-bottom: 20px;
    text-align: center;
}

/* Individual Comments */
.comment {
    background: #f9f9f9;
    padding: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    margin-bottom: 15px;
}

.comment p {
    margin: 5px 0;
    font-size: 0.9rem;
    color: #555;
}

.comment strong {
    font-size: 1rem;
    color: #333;
}

/* Delete Comment Link */
.comment a {
    display: inline-block;
    margin-top: 10px;
    font-size: 0.9rem;
    color: #ff4d4d;
    text-decoration: none;
    transition: color 0.3s ease;
}

.comment a:hover {
    color: #ff1a1a;
}

/* Comment Form */
.comment-form {
    margin-top: 20px;
    padding: 20px;
    background: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
}

.comment-form label {
    font-size: 1rem;
    color: #333;
    display: block;
    margin-bottom: 5px;
}

.comment-form input,
.comment-form textarea {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

.comment-form input[type="submit"] {
    background-color: #004085;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 1rem;
    border-radius: 5px;
}

.comment-form input[type="submit"]:hover {
    background-color: #0062cc;
}

/* Responsive Design */
@media (max-width: 768px) {
    .post-title {
        font-size: 1.5rem;
    }

    .like-btn,
    .dislike-btn,
    .back-btn {
        font-size: 0.9rem;
        padding: 8px 15px;
    }
}

    </style>
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
