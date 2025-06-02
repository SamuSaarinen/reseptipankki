<?php require_once '../views/partials/header.php'; ?>

<h1>Omat tiedot</h1>

<div class="profile-info">
    <p><strong>Käyttäjätunnus:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Sähköposti:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Syntymävuosi:</strong> <?= $user['birthyear'] ?></p>
    <p><strong>Ikä:</strong> <?= date('Y') - $user['birthyear'] ?> vuotta</p>
</div>

<?php require_once '../views/partials/footer.php'; ?>