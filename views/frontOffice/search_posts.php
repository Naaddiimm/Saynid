<?php
include_once '../../controllers/PostC.php';


$searchText = isset($_GET['searchText']) ? $_GET['searchText'] : '';

$postC = new PostC();

$searchResults = $postC->searchPosts($searchText);

$html = '';
foreach ($searchResults as $post) {
    $html .= '<div class="box" id="box-posts">';
    $html .= '<a href="post_details.php?id=' . $post['ID_post'] . '">';
    $html .= '<img src="../Images/' . $post['Image'] . '">';
    $html .= '<h4>' . $post['Titre'] . '</h4>';
    $html .= '</a>';
    $html .= '<p>Likes: ' . $post['Likes'] . ' Dislikes: ' . $post['Dislikes'] . '</p>';
    $html .= '<p>Commentaires: ' . $post['Commentaires'] . '</p>';
    $html .= '<p>' . $post['Auteur'] . ' ' . $post['Date_Publication'] . '</p>';
    $html .= '</div>';
}
echo $html;
?>
