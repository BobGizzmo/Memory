<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/styles/css/styles.css">
    <title>Memory !</title>
</head>
<body>
    <main>
        <section>
            <h1>JEU DE MÉMOIRE</h1>
            <noscript>Ce jeu fonctionne avec JavaScript, merci de l'activer</noscript>
            <article>
                <div class="scores">
                    <ul>
                    <?php foreach($scores as $value) : ?>
                        <li><?= $value->getUsername() ?>: <?= $value->formatTimer($value->getTimer()) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
                <div class="field" id="field">
                </div>
            </article>
            
            <div class="containerProgresseBar">
                <div id="progresseBar"></div>
            </div>
        </section>
    </main>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="/assets/scripts/class/Card.js"></script>
    <script src="/assets/scripts/class/Game.js"></script>
    <script src="/assets/scripts/class/Timer.js"></script>
    <script src="/assets/scripts/script.js"></script>
</body>
</html>