<?php
if (!isset($_GET['id'])) {
    header('Location: ./index.php');
    exit;
}

// Funktio tiedostonimen siistimiseen
function slugify($text) {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '_', $text);
    return trim($text, '_');
}

$recipe = query("SELECT * FROM recipes WHERE id = ?", [$_GET['id']])->fetch();

if (!$recipe) {
    header('Location: ./index.php');
    exit;
}

// Luo yksinkertainen HTML PDF:n sijasta
header('Content-Type: text/html');
header('Content-Disposition: attachment; filename="' . slugify($recipe['name']) . '.html"');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($recipe['name']) ?></title>
    <style>
        body { font-family: Arial; line-height: 1.6; }
        h1 { color: #333; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($recipe['name']) ?></h1>
    <div class="section">
        <strong>Category:</strong> <?= ucfirst($recipe['category']) ?>
    </div>
    <div class="section">
        <h2>Ingredients</h2>
        <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
    </div>
    <div class="section">
        <h2>Instructions</h2>
        <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>
    </div>
    <p>Exported on <?= date('Y-m-d H:i:s') ?></p>
</body>
</html>
<?php exit; ?>
