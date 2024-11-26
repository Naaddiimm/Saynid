<?php
include_once '../../controllers/CommentC.php';
include "../../controllers/PostC.php";

$commentID = $_GET['id'];

$commentC = new CommentC();
$comment = $commentC->showComment($commentID);

if ($comment) {
    $postID = $comment['ID_post'];

    $commentC->deleteComment($commentID);

    $postC = new PostC();
    $postC->decrementCommentCount($postID);

    header('location: Blog.php');
    
} else {
    echo "Le commentaire n'existe pas.";
}
?>
 