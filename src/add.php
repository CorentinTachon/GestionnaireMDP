<?php
include 'database.php';
include 'encrypt.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site = $_POST['site'];
    $password = $_POST['password'];
    $encrypted_password = encrypt($password);

    $stmt = $pdo->prepare("INSERT INTO passwords (site, password) VALUES (?, ?)");
    $stmt->execute([$site, $encrypted_password]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Mot de Passe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="container mx-auto mt-10">
    <h2 class="text-center text-2xl font-bold mb-5">Ajouter un Mot de Passe</h2>
    <form action="add.php" method="post" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="site" class="block text-gray-700 text-sm font-bold mb-2">Site:</label>
            <input type="text" name="site" id="site" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de Passe:</label>
            <input type="text" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ajouter</button>
            <a href="index.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Annuler</a>
        </div>
    </form>
</body>
</html>