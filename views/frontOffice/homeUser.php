<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME</title>

    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <script src="../frontOffice/public/home.js"></script>
</head>
<body>

    <header>
        <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="#cours" onclick="showSection('cours')">Cours</a></li>
            <li><a href="#test" onclick="showSection('test')">Test</a></li>
            <li><a href="#payement" onclick="showSection('payement')">Payement</a></li>
            <li><a href="#progress" onclick="showSection('progress')">Progress</a></li>
            <li><a href="#stage" onclick="showSection('stage')">Stage</a></li>
            <li><a href="../frontOffice/Blog.php">HOME</a></li>
        </ul>
    </nav>

    <main>
        <!-- Section Cours -->
        <section id="cours" class="section active">
            <h2>COURS</h2>
            <div class="cours-item">
                <h3>MATH</h3>
                <p>Cours math</p>
            </div>
            <div class="cours-item">
                <h3>JAVA</h3>
                <p>Cours java</p>
            </div>
            <div class="cours-item">
                <h3>C / C++</h3>
                <p>Cours C / C++</p>
            </div>
        </section>

        <!-- Section Test -->
        <section id="test" class="section">
            <h2>TEST</h2>
            <div class="test-item">
                <h3>TEST MATH</h3>
                <p>Contenu du test de Mathématiques.</p>
            </div>
            <div class="test-item">
                <h3>TEST JAVA</h3>
                <p>Contenu du test de Java.</p>
            </div>
        </section>

        <!-- Section Payement -->
        <section id="payement" class="section">
            <h2>Payement</h2>
            <div class="courses-container">
                <div class="course-card">
                    <h3>JAVA</h3>
                    <img src="../frontOffice/public/JAVA.png" alt="Image du cours JAVA">
                    <div class="price">€100</div>
                    <button onclick="addToCart('JAVA', 100)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>HTML/PHP</h3>
                    <img src="../frontOffice/public/HTML.png" alt="Image du cours HTML/PHP">
                    <div class="price">€100</div>
                    <button onclick="addToCart('HTML/PHP', 100)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>C / C++</h3>
                    <img src="../frontOffice/public/C.png" alt="Image du cours C / C++">
                    <div class="price">€100</div>
                    <button onclick="addToCart('C / C++', 100)">Acheter</button>
                </div>
            </div>
            <div id="cart-details" style="display: none;">
                <h3>Panier</h3>
                <ul id="cart-items"></ul>
                <p id="total-price">Prix Total: €0</p>
                <input type="text" id="card-number" placeholder="Votre Numéro de carte">
                <button class="validate-btn" onclick="validateCart()">Valider l'Achat</button>
                <button class="remove-btn" onclick="removeSelectedCourses()">Retirer Cours</button>
                <button class="clear-btn" onclick="clearCart()">Vider le Panier</button>
            </div>
        </section>

        <!-- Autres sections -->
        <section id="progress" class="section">
            <h2>PROGRESS</h2>
        </section>

        <section id="stage" class="section">
            <h2>STAGE</h2>
        </section>

    </main>
</body>
</html>
