//On attend que le DOM soit entièrement chargé
$.when( $.ready ).then(function() {
    //Requête AJAX Get
    $.ajax('/?p=game.getImages')
        .done(function(data) {
            let response = JSON.parse(data);//On transforme la réponse que nous a renvoyé php en tableau JSON

            Img.images = response;
            Img.generate($('.cards'));//Appelle de la méthode "generate" de l'objet Image

            $('.cards').click(function(){//On applique un event "click" à toute nos cartes
            Img.checkCards(this);
                //On modifie la src de l'image ? sur laquelle on a cliqué par la vraie image correspondante
                let id = $(this).data("id");
                id = id.split('-')[0];
                $(this).attr('src', response[id].src);
                //Démarrage du timer
                Timer.begin(Img.successCards.length, response.length);
            });
        })
        .fail(function(error) {
            if(error.status == 404) {
                alert("Une erreur s'est produite,\n jeu de carte introuvable");
            }
        });
});