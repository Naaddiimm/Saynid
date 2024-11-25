<?php  
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require_once(__DIR__ . '/../../controllers/UserController.php');
$userController = new UserController();
$profilePicture = $userController->getProfilePicture($_SESSION['username']); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <script src="../frontOffice/public/home.js" defer></script>
    
  <style>
    .highlighted-course {
            border: 3px solid rgb(63, 60, 223);
            border-radius: 8px;
            box-shadow: 0 0 15px #ff9800;
            transform: scale(1.1);
            transition: all 0.3s ease-in-out;
        }

    .profile-picture {
      display: block;
      margin: 0 auto 20px auto;
      width: 150px; /* Redimensionne la photo */
      height: 150px;
      border-radius: 50%; /* Contour circulaire */
      object-fit: cover; /* Garde la photo proportionnée */
    }

 </style>
</head>
<body>

    <header>
        <h1>Bienvenue <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="#cours" onclick="showSection('cours')">Cours</a></li>
            <li><a href="#test" onclick="showSection('test')">Test</a></li>
            <li><a href="#payement" onclick="showSection('payement')">Payement</a></li>
            <li><a href="#stage" onclick="showSection('stage')">Stage</a></li>
            <li><a href="#Profile" onclick="showSection('Profile')">Profile</a></li>
            <li><a href="../frontOffice/index.html">Accueil</a></li>
        </ul>
    </nav>

    <main>

<!-- Section Profile -->
<section id="Profile" class="section">
        <h2>Gestion de compte</h2>

        <div class="profile-picture">
            <img src="../../uploads/profiles/<?php echo htmlspecialchars($profilePicture); ?>" alt="Photo de profil" class="profile-picture">
        </div>

        <!-- Formulaire de mise à jour du mot de passe -->
        <div class="form-container">
        <h2>Mettre à jour votre mot de passe</h2>
        <form method="POST" action="../backOffice/updateUser.php" enctype="multipart/form-data">
            
           <div class="form-group">
            <label for="oldPassword">Ancien mot de passe :</label>
            <input type="password" id="oldPassword" name="oldPassword" required>
         </div>
            
         <div class="form-group">
             <label for="newPassword">Nouveau mot de passe :</label>
            <input type="password" id="newPassword" name="newPassword" required>
         </div>  
          
         <div class="form-group">
            <label for="confirmNewPassword">Confirmer le mot de passe :</label>
            <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
         </div>    
            <button type="submit">Mettre à jour</button>
        </form>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de mise à jour de la photo de profil -->
        <h2>Mettre à jour votre photo de profil</h2>
        <form method="POST" action="../backOffice/updateUser.php" enctype="multipart/form-data">
            <label for="profile_picture">Choisir une photo :</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            <button type="submit">Mettre à jour la photo</button>
        </form>

        </div>
    </section>

        <!-- Section Cours -->
        <section id="cours" class="section ">
            <h2>COURS</h2>
            
        </section>

        <section id="payement" class="section">
            <h2>Payement</h2>
            
        </section>

    </main>
    
</body>
</html>
