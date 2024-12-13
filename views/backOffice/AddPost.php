<html>
    <head>
    <style>/* Global styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fa;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Container for the form */
form {
    width: 70%;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Table styles */
table {
    width: 100%;
    border-spacing: 15px;
}

td {
    padding: 10px;
    vertical-align: middle;
}

label {
    font-size: 16px;
    color: #555;
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-bottom: 15px;
}

input[type="text"]:focus,
input[type="file"]:focus {
    border-color: #007bff;
    outline: none;
}

/* Submit and Reset buttons */
input[type="submit"],
input[type="reset"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #0056b3;
}

/* Alerts and Error messages */
.alert {
    padding: 15px;
    background-color: #f44336;
    color: white;
    margin-top: 15px;
    border-radius: 4px;
    text-align: center;
}

/* Reset button styling */
input[type="reset"] {
    background-color: #f0f0f0;
    color: #333;
    border: 1px solid #ddd;
}

input[type="reset"]:hover {
    background-color: #ddd;
}

/* Heading styles */
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-size: 24px;
}
</style>    
    
    
    
    
    
    <link rel="stylesheet" href="../CSS/StyleAdd.css"/></head>
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
    header('location:homeAdmin.php');
}
?>  