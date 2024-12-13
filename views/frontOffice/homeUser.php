<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include '../../controllers/PostC.php';
include '../../controllers/CommentC.php';
$PostC=new PostC();
$liste=$PostC->listPosts();
$commentC=new CommentC();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saynid</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/dashboard.css">
    <style>
        /* Posts Section */
.tour-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 colonnes */
    gap: 20px; /* Espacement entre les boîtes */
    margin-top: 20px;
}

.box {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.box img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 10px;
}

.box h4 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 10px;
}

.box p {
    font-size: 0.9rem;
    color: #555;
    margin: 5px 0;
}

.box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Top Posts Section */
.top-posts .tour-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 20px;
}

/* Search Bar */
.searchbar {
    display: block;
    margin: 20px auto;
    padding: 10px 15px;
    font-size: 1rem;
    border: 2px solid #004085;
    border-radius: 5px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.searchbar:focus {
    border-color: #0062cc;
    outline: none;
}

/* Adjustments for Section Headers */
.center-text h2 {
    font-size: 1.8rem;
    color: #004085;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.center-text {
    text-align: center;
}

/* Button Styling */
button {
    background-color: #004085;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

button:hover {
    background-color: #0062cc;
    transform: translateY(-2px);
}

/* Global Adjustments for Responsiveness */
@media (max-width: 768px) {
    .tour-content {
        grid-template-columns: repeat(2, 1fr);
    }

    .searchbar {
        width: 90%;
    }
}

@media (max-width: 480px) {
    .tour-content {
        grid-template-columns: 1fr;
    }

    .searchbar {
        width: 100%;
    }
}

    </style>
</head>
<body> 
    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="logo">
            <img src="assets/img/saynid.png" alt="Logo">
            <span class="welcome-text">Bienvenue</span> 
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="#profile" onclick="showSection('profile')" class="active"><i class="fas fa-user-circle"></i> Profil</a></li>
                <li><a href="#cours" onclick="showSection('cours')"><i class="fas fa-book"></i> Cours</a></li>
                <li><a href="#panier" onclick="showSection('panier')"><i class="fas fa-shopping-cart"></i> Panier</a></li>
                <li><a href="#blog" onclick="showSection('blog')"><i class="fas fa-pen"></i> Blog</a></li>
                <li><a href="#test" onclick="showSection('test')"><i class="fas fa-tasks"></i> Test</a></li>
                <li><a href="#stage" onclick="showSection('stage')"><i class="fas fa-briefcase"></i> Stage</a></li>
            </ul>
        </nav>
        <button class="logout-btn">Se déconnecter</button>
        
    </header>

    <!-- Main Content -->
    <main class="content">
        <section id="profile-content" class="section-content active">
            <h2>Profil</h2>
            <p>Bienvenue dans votre espace personnel.</p>
        </section>
        <section id="cours-content" class="section-content">
            <h2>Cours</h2>
            <p>Accédez à une bibliothèque de cours enrichissante.</p>
        </section>
        <section id="panier-content" class="section-content">
            <h2>Panier</h2>
            <p>Consultez les articles que vous avez ajoutés.</p>
        </section>
        <section id="blog-content" class="section-content">
            <h2>Blog</h2>
            <p>Découvrez les dernières nouvelles et articles.</p>
            <section class="tour" id="posts-section">
    <div class="center-text">
      <h2>Posts</h2>
      <input type="text" id="searchInput" class="searchbar" placeholder="Rechercher par titre...">
    </div>
    <div id="normalPosts" class="tour-content">
    <?php foreach($liste as $post): ?>
    <div class="box" id="box-posts">
        <a href="post_details.php?id=<?= $post['ID_post']; ?>">
            <img src="../Images/<?= $post['Image']; ?>">
            <h4><?= $post['Titre']; ?></h4>
        </a>
        <p>Likes : <?= $post['Likes']; ?> Dislikes : <?= $post['Dislikes']; ?></p>
        <p>Commentaires: <?= $post['Commentaires']; ?></p>
        <p><?= $post['Auteur']; ?> <?= $post['Date_Publication']; ?></p>
    </div>
<?php endforeach; ?>
  </section>
  <section class="top-posts">
    <div class="center-text">
        <h2>Top 3 des Meilleurs Posts</h2>
    </div>
    <div class="tour-content">
        <?php $topPosts = $PostC->getTopPosts(); ?>
        <?php foreach($topPosts as $post): ?>
            <div class="box" id="box-top-posts">
                <a href="post_details.php?id=<?= $post['ID_post']; ?>">
                    <img src="../Images/<?= $post['Image']; ?>">
                    <h4><?= $post['Titre']; ?></h4>
                </a>
                <p>Likes : <?= $post['Likes']; ?> Dislikes : <?= $post['Dislikes']; ?></p>
                <p>Commentaires: <?= $post['Commentaires']; ?></p>
                <p><?= $post['Auteur']; ?> <?= $post['Date_Publication']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
        <section id="test-content" class="section-content">
            <h2>Test</h2>
            <p>Passez des évaluations et des tests.</p>
        </section>
        <section id="stage-content" class="section-content">
            <h2>Stage</h2>
            <p>Trouvez des opportunités pour lancer votre carrière.</p>
        </section>
    </main>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            const links = document.querySelectorAll('.nav-links a');
            sections.forEach(section => section.classList.remove('active'));
            links.forEach(link => link.classList.remove('active'));
            document.getElementById(sectionId + '-content').classList.add('active');
            document.querySelector(`[href="#${sectionId}"]`).classList.add('active');
        }
        document.addEventListener('DOMContentLoaded', () => showSection('profile'));
    </script>
</body>
</html>

