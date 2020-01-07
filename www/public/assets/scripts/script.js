//On attend que le DOM soit entièrement chargé
$.when( $.ready ).then(function() {
    Game.start(
            $('#field'), //Terrain de jeux
            $('#containerProgresseBar') //Container de la barre de progression
        );
});