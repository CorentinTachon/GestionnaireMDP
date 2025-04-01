<?php
$pdo = new PDO('sqlite:passwords.db');
$pdo->exec("CREATE TABLE IF NOT EXISTS passwords (id INTEGER PRIMARY KEY, site TEXT, password TEXT)");

if (!function_exists('enregistrerMotDePasse')) {
    function enregistrerMotDePasse($site, $password) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO passwords (site, password) VALUES (?, ?)");
        $stmt->execute([$site, $password]);
    }
}

if (!function_exists('afficherMotsDePasse')) {
    function afficherMotsDePasse() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM passwords");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['site']}</td>
                    <td>{$row['password']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Modifier</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Supprimer</a>
                    </td>
                  </tr>";
        }
    }
}

if (!function_exists('recupererMotDePasse')) {
    function recupererMotDePasse($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT password FROM passwords WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
}

if (!function_exists('supprimerMotDePasse')) {
    function supprimerMotDePasse($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM passwords WHERE id = ?");
        $stmt->execute([$id]);
    }
}

if (!function_exists('modifierMotDePasse')) {
    function modifierMotDePasse($id, $site, $password) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE passwords SET site = ?, password = ? WHERE id = ?");
        $stmt->execute([$site, $password, $id]);
    }
}
?>