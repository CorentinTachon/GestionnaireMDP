<?php
include 'database.php';
include 'decrypt.php';

$stmt = $pdo->prepare("SELECT * FROM passwords");
$stmt->execute();
$passwords = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Mots de Passe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function showPassword(button) {
            var passwordField = button.parentElement.parentElement.querySelector('input[type="password"]');
            if (passwordField) {
                alert("Mot de Passe: " + passwordField.value);
            } else {
                console.error("Password field not found");
            }
        }
    </script>
</head>
<body class="container mx-auto mt-10">
    <h2 class="text-center text-2xl font-bold mb-5">Liste des Mots de Passe</h2>
    <div class="mb-4">
        <a href="add.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ajouter un Mot de Passe</a>
    </div>
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-2 px-4">Site</th>
                <th class="py-2 px-4">Mot de Passe</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($passwords as $password): ?>
            <tr class="border-b">
                <td class="border px-4 py-2"><?php echo htmlspecialchars($password['site'] ?? ''); ?></td>
                <td class="border px-4 py-2">
                    <input type="password" value="<?php echo htmlspecialchars(decrypt($password['password']) ?? ''); ?>" class="bg-gray-100 p-2 rounded" readonly>
                </td>
                <td class="border px-4 py-2">
                    <button onclick="showPassword(this)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Voir le Mot de Passe</button>
                    <a href="update.php?id=<?php echo $password['id']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</a>
                    <a href="delete.php?id=<?php echo $password['id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>