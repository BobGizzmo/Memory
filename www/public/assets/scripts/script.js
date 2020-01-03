//On attend que le DOM soit entièrement chargé
$.when( $.ready ).then(function() {
    const timer = new Timer();//Instanciation de la class Timer

    //Requête AJAX Get
    $.ajax('/?p=game.getImages')
        .done(function(data) {
            let response = JSON.parse(data);//On transforme la réponse que nous a renvoyé php en tableau JSON

            const images = new Image(response);//Instanciation de la class Image
            images.generate($('.cards'));//Appelle de la méthode "generate" de l'objet images

            $('.cards').click(function(){//On applique un event "click" à toute nos cartes
                images.checkCards(this);
                //On modifie la src de l'image ? sur laquelle on a cliqué par la vraie image correspondante
                let id = $(this).data("id");
                id = id.split('-')[0];
                $(this).attr('src', response[id].src);
                //Démarrage du timer
                timer.begin(images.successCards.length, response.length);
            });
        })
        .fail(function(error) {
            if(error.status == 404) {
                alert("Une erreur s'est produite,\n jeu de carte introuvable");
            }
        });
});