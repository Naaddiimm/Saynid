<?php
include_once 'C:/xampp/htdocs/projet/config/config.php';
include 'C:/xampp/htdocs/projet/models/Post.php';

class PostC
{
    public function listPosts()
    {
        $sql="SELECT * FROM post";
        $db=config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch(Exception $e)
        {
            die('Erreur :' .$e->getMessage());
        }
    }
    public function DeletePost($id)
    {
        $sql="DELETE FROM post WHERE ID_Post=:ID_Post";
        $db=config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':ID_Post',$id);
        try
        {
            $req->execute();
        }
        catch(Exception $e)
        {
            die('Error:' .$e->getMessage());
        }
    }
    public function AddPost($post)
    {
        $sql = "INSERT INTO post VALUES (NULL, :Ti, :C, :A, :D, :Ta, :L, :DL, :Cm, :Im)";
        $db=config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute([
                'Ti'=>$post->getTitre(),
                'C'=>$post->getContenu(),
                'A'=>$post->getAuteur(),
                'D'=>$post->getDate_Publication()->format('Y/m/d'),
                'Ta'=>$post->getTags(),
                'L'=>$post->getLikes(),
                'DL'=>$post->getDislikes(),
                'Cm'=>$post->getCommentaires(),
                'Im'=>$post->getImage(),
            ]);
        } catch(Exception $e){
            echo 'Error :' .$e->getMessage();
        }
    }
    public function getPostById($id)
    {
    $sql = "SELECT * FROM post WHERE ID_post = :ID_post";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['ID_post' => $id]);
        $blogData = $query->fetch(PDO::FETCH_ASSOC);

        
        if ($blogData) {
           
            $post = new Post(
                $blogData['ID_post'],
                $blogData['Titre'],
                $blogData['Contenu'],
                $blogData['Auteur'],
                new DateTime($blogData['Date_Publication']), 
                $blogData['Tags'],
                $blogData['Likes'],
                $blogData['Dislikes'],
                $blogData['Commentaires'],
                $blogData['Image']
            );            
            return $post;
        } else {
        
            return null;
        }
    } catch (Exception $e) {
      
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}
public function UpdatePost($post, $id)
{
    $sql = "UPDATE post SET 
            Titre = :Ti, 
            Contenu = :C, 
            Auteur = :A, 
            Date_Publication = :D, 
            Tags = :Ta, 
            Likes = :L, 
            Dislikes = :DL, 
            Commentaires = :Cm, 
            Image = :Im 
            WHERE ID_post = :ID_post";
    
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'Ti' => $post->getTitre(),
            'C' => $post->getContenu(),
            'A' => $post->getAuteur(),
            'D' => $post->getDate_Publication()->format('Y-m-d'), // Format Date
            'Ta' => $post->getTags(),
            'L' => $post->getLikes(),
            'DL' => $post->getDislikes(),
            'Cm' => $post->getCommentaires(),
            'Im' => $post->getImage(),
            'ID_post' => $id
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


function showPost($id)
{
    $sql = "SELECT * from post where ID_post = $id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        $post = $query->fetch();
        return $post;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
public function incrementLikes($postID)
    {
    $sql = "UPDATE post SET Likes = Likes + 1 WHERE ID_post = :ID_post";
    $db = config::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':ID_post', $postID);
    $stmt->execute();
    }

    public function incrementDislikes($postID)
    {
    $sql = "UPDATE post SET Dislikes = Dislikes + 1 WHERE ID_post = :ID_post";
    $db = config::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':ID_post', $postID);
    $stmt->execute();
    }
    public function incrementCommentCount($postID)
{
    $sql = "UPDATE post SET Commentaires = Commentaires + 1 WHERE ID_post = :ID_post";
    $db = config::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':ID_post', $postID);
    $stmt->execute();
}
public function decrementCommentCount($postID)
    {
        $sql = "UPDATE post SET Commentaires = Commentaires - 1 WHERE ID_post = :ID_post";
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':ID_post', $postID);
        $stmt->execute();
    }
    public function searchPosts($searchText)
{
    $sql = "SELECT * FROM post WHERE Titre LIKE :searchText OR Tags LIKE :searchText";

    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);

        $searchParam = "%" . $searchText . "%";
        $stmt->bindParam(':searchText', $searchParam, PDO::PARAM_STR);

        $stmt->execute();

        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $searchResults;
    } catch (PDOException $e) {
        echo "Erreur lors de la recherche des posts: " . $e->getMessage();
        return array(); 
    }
}
public function getTopPosts()
{
    $sql = "SELECT * FROM post 
            ORDER BY (Likes + Commentaires - Dislikes) DESC
            LIMIT 3";

    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $topPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $topPosts;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des meilleurs posts: " . $e->getMessage();
        return array(); 
    }
}
}
?>