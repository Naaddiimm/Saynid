<?php
include_once 'C:/xampp/htdocs/projet/config/config.php';
include 'C:/xampp/htdocs/projet/models/Comment.php';

class CommentC
{
    public function listComments()
    {
        $sql = "SELECT * FROM comment";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }

    public function deleteComment($id)
    {
        $sql = "DELETE FROM comment WHERE ID_Comment=:ID_Comment";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_Comment', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addComment($comment)
    {
        $sql = "INSERT INTO comment VALUES (NULL, :ID_post, :Contenu, :Pseudo, :Date_Publication, :Likes)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_post' => $comment->getID_Post(),
                'Contenu' => $comment->getContenu(),
                'Pseudo' => $comment->getPseudo(),
                'Date_Publication' => $comment->getDate_Publication()->format('Y/m/d'),
                'Likes' => $comment->getLikes(),
            ]);
        } catch (Exception $e) {
            echo 'Error :' . $e->getMessage();
        }
    }

    public function updateComment($comment, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE commentaire SET 
                    Contenu = :Contenu, 
                    Pseudo = :Pseudo, 
                    Date_Publication = :Date_Publication, 
                    Likes = :Likes 
                WHERE ID_Comment= :ID_Comment'
            );
            $query->execute([
                'ID_Comment' => $id,
                'Contenu' => $comment->getContenu(),
                'Pseudo' => $comment->getPseudo(),
                'Date_Publication' => $comment->getDate_Publication()->format('Y/m/d'),
                'Likes' => $comment->getLikes(),
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showComment($id)
    {
        $sql = "SELECT * from comment where ID_Comment = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $comment = $query->fetch();
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listCommentsByPost($id)
{
    $sql = "SELECT * FROM comment WHERE ID_post = :ID_post";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':ID_post', $id);
        $query->execute();

        $comments = $query->fetchAll();
        return $comments;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
public function filterBadWords($text)
    {
        $badWords = array("war", "genocide", "death");

        foreach ($badWords as $word) {
            $text = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', '***', $text);
        }

        return $text;
    }

    public function replaceWordsWithEmojis($text)
    {
        $wordToEmojiMap = array(
        "happy" => "😊",
        "love" => "❤️",
        "cool" => "😎",
        "great" => "👍",
        "awesome" => "🌟",
        "fun" => "🎉",
        "amazing" => "😲",
        "laugh" => "😂",
        "bravo" => "👏",
        "thanks" => "🙏",
        "victory" => "✌️",
        "celebrate" => "🥳",
        "excited" => "🤩",
        "inspiring" => "🌈",
        "fantastic" => "🌟",
        "beautiful" => "🌸",
        "wonderful" => "🌟",
        "delight" => "😄",
        "magic" => "✨",
        );

        foreach ($wordToEmojiMap as $word => $emoji) {
            $text = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', $emoji, $text);
        }

        return $text;
    }

}
?>
