<?php
require_once(__DIR__ . '/../../config/config.php'); 
require_once(__DIR__ . '/../../controllers/UserController.php');

// Démarrer la session si elle n'est pas active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title> ADMIN </title>
    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <style>
      .section { display: none; }
      .section.active { display: block; }
    </style>
</head>
<body>
    <header>
        <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#cours" onclick="showSection('Cours')">Cours</a></li>
            <li><a href="#test" onclick="showSection('TEST')">Test</a></li>
            <li><a href="#Stage" onclick="showSection('Stage')">Stage</a></li>
            <li><a href="#dashboard" onclick="showSection('Dashboard')">Dashboard</a></li>
            <li><a href="../frontOffice/index.html">HOME</a></li>
            <li><a href="../backOffice/ListePosts.php">Blog</a></li>
        </ul>
    </nav>

    <main>
        <section id="Cours" class="section active">
            <h2>COURS</h2>
            <div>
                <h3>HTML/PHP</h3>

            </div>
            <div>
                <h3>JAVA</h3>

            </div>
            <div>
                <h3>C / C++</h3>

            </div>

            <h2>Ajouter un nouveau cours</h2>

        </section>

        <section id="Stage" class="section">
            <h2>STAGE</h2>
            <div class="stage-item"></div>
        </section>

        <section id="TEST" class="section">
        <h2>TEST</h2>
        <div class="TEST-item"></div>
               
        </section>

        <!-- Nouvelle section Dashboard -->
        <section id="Dashboard" class="section">
            <h2>Dashboard</h2>
            <p>Bienvenue sur le tableau de bord. Vous pouvez ici visualiser diverses statistiques et informations importantes.</p>
            <div>
                <h3>Statistiques</h3>
                <p>Exemple de statistiques sur les cours, utilisateurs ou autres données pertinentes à votre application.</p>
            </div>
            <div>
                <h3>Graphiques</h3>
                <p>Vous pouvez ici afficher des graphiques ou des données visuelles pour mieux comprendre les tendances et l'évolution des données.</p>
            </div>
        </section>
    </main>
 
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.toggle('active', section.id === sectionId);
            });
        }
    </script>
</body>
</html>


