<?php require_once __DIR__ . '..\..\includes\header.php'; ?>

<h1>Yhteystiedot</h1>

<div class="contact-info">
    <h2>Ota yhteyttä</h2>
    <p>Sähköposti: info@reseptisivusto.fi</p>
    <p>Puhelin: 040 123 4567</p>
    <p>Osoite: Reseptikatu 1, 00100 Helsinki</p>
</div>

<h2>Lähetä viesti</h2>
<form class="contact-form">
    <div>
        <label for="name">Nimi:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Sähköposti:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="message">Viesti:</label>
        <textarea id="message" name="message" required></textarea>
    </div>
    <button type="submit" class="button">Lähetä</button>
</form>

<?php require_once __DIR__ . '\..\includes\footer.php'; ?>