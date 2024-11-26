<html>
    <head><link rel="stylesheet" href="../CSS/StyleAdd.css"/></head>
    <script>
function validerForm() {
    var titre = document.getElementById("Titre").value;
    var contenu = document.getElementById("Contenu").value;
    var auteur = document.getElementById("Auteur").value;
    var tags = document.getElementById("Tags").value;
    var image = document.getElementById("Image").value;

    if (titre == "" || contenu == "" || auteur == "" || tags == "" || image == "") {
        alert("Veuillez remplir tous les champs.");
        return false;
    }

    if (!tags.startsWith("#")) {
        alert("Le tag doit commencer par un #.");
        return false;
    }

    if (titre.charAt(0) !== titre.charAt(0).toUpperCase()) {
        alert("Le titre doit commencer par une majuscule.");
        return false;
    }

    if (contenu.length <= 10) {
        alert("Le contenu doit contenir plus de 10 lettres.");
        return false;
    }

    if (/\d/.test(titre)) {
        alert("Le titre ne doit pas contenir de chiffres.");
        return false;
    }

    if (/\d/.test(auteur)) {
        alert("L'auteur ne doit pas contenir de chiffres.");
        return false;
    }

    return true;
}
</script>
<form action="../backOffice/AddPost.php" method="post" enctype="multipart/form-data" onsubmit="return validerForm()">
<table>
    <tr>
        <td><label for="Titre">Titre : </label></td>
        <td><input type="text" id="Titre" name="Titre" ></td>
    </tr>
    <tr>
        <td><label for="Contenu">Contenu :</label></td>
        <td><input type="text" id="Contenu" name="Contenu" ></td>
    </tr>
    <tr>
        <td><label for="Auteur">Auteur :</label></td>
        <td><input type="text" id="Auteur" name="Auteur" ></td>
    </tr>
    <tr>
        <td><label for="Tags">Tags :</label></td>
        <td><input type="text" id="Tags" name="Tags"></td>
    </tr>
    <tr>
        <td><label for="Image">Choisir une image :</label> </td>
        <td><input type="file" id="Image" name="Image"> </td>
    </tr>
    <tr>
        <td><input type="submit" value="Submit" ></td>
        <td><input type="reset" value="Reset" ></td>
    </tr>
</table>
</form>
</html>
<?php
include "../../controllers/PostC.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Titre = $_POST['Titre'];
    $Contenu = $_POST['Contenu'];
    $Auteur = $_POST['Auteur'];
    $Tags = $_POST['Tags'];
    
    $Image = $_FILES['Image'];

    if ($Image['error'] === UPLOAD_ERR_OK) {
        $target_path = "../Images/";

        $target_file = $target_path . basename($Image['name']);

        if (move_uploaded_file($Image['tmp_name'], $target_file)) {
            $DatePublication = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
            $p = new Post(NULL, $Titre, $Contenu, $Auteur, $DatePublication, $Tags, 0, 0, 0, basename($Image['name']));
            
            $x = new PostC();
            $x->AddPost($p);
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
    header('location:ListePosts.php');
}
?>  