<?php
class Comment
{
    private ?int $ID_Comment = null;
    private ?int $ID_Post = null;
    private ?string $Contenu;
    private ?string $Pseudo;
    private ?DateTime $Date_Publication;
    private ?int $Likes;

    public function __construct($ID_Comment = null, $ID_Post = null, $Contenu, $Pseudo, $Date_Publication, $Likes)
    {
        $this->ID_Comment = $ID_Comment;
        $this->ID_Post = $ID_Post;
        $this->Contenu = $Contenu;
        $this->Pseudo = $Pseudo;
        $this->Date_Publication = $Date_Publication;
        $this->Likes = $Likes;
    }

    public function getID_Comment(){return $this->ID_Comment;}
    public function getID_Post(){return $this->ID_Post;}
    public function getContenu(){return $this->Contenu;}
    public function getPseudo(){return $this->Pseudo;}
    public function getDate_Publication(){return $this->Date_Publication;}
    public function getLikes(){return $this->Likes;}

    public function setContenu(string $val){$this->Contenu = $val;}
    public function setPseudo(string $val){$this->Pseudo = $val;}
    public function setDate_Publication(DateTime $val){$this->Date_Publication = $val;}
    public function setLikes(int $val){$this->Likes=$val;}
}
?>