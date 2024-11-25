<?php  
require_once(__DIR__ . '/../../config/config.php'); 
require_once(__DIR__ . '/../../controllers/UserController.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}

$userController = new UserController();
$visitors = $userController->getVisitors();

?>
<!DOCTYPE html>
<html>
<head>
    <title> ADMIN </title>
    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <link href="../frontOffice/public/homeA.css" rel="stylesheet">
    <script src="../frontOffice/public/homeA.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        </ul>
    </nav>

    <main>
        <section id="Cours" class="section active">
            <h2>COURS</h2>
           

        </section>

        <section id="Stage" class="section">
            <h2>STAGE</h2>
            <div class="stage-item"></div>
        </section>

        <section id="TEST" class="section">
            <h2>TEST</h2>
            <div class="TEST-item"></div>
        </section>

         <!-- DASHROARD -->

    <section id="Dashboard" class="section">
            <h2>Dashboard</h2>

            <h3>Gestion des utilisateurs</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visitors as $visitor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($visitor['username']); ?></td>
                            <td class="<?php echo $visitor['active'] ? 'status-active' : 'status-inactive'; ?>">
                                <?php echo $visitor['active'] ? 'Actif' : 'Inactif'; ?>
                            </td>
                            <td>
                                <!-- Blocage -->
                                <form action="userAction.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($visitor['username']); ?>">
                                    <input type="hidden" name="action" value="block">
                                    <button type="submit" class="btn-block" <?php echo $visitor['active'] ? "" : "disabled"; ?>>Bloquer</button>
                                </form>

                                <!-- Déblocage -->
                                <form action="userAction.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($visitor['username']); ?>">
                                    <input type="hidden" name="action" value="unblock">
                                    <button type="submit" class="btn-unblock" <?php echo !$visitor['active'] ? "" : "disabled"; ?>>Débloquer</button>
                                </form>

                                <!-- Suppression -->
                                <form action="userAction.php" method="post" style="display: inline-block;" onsubmit="return confirmDelete()">
                                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($visitor['username']); ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

           
        </section>

    </main>
</body>

</html>
