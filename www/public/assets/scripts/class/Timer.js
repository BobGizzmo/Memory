const Timer = {

    limit : 3,//Limite de temps en minute
    top : true,
    min : 0,
    sec : 0,
    interval: null,
    originalEntries : 0,
    successEntries : 0,
    time : 0,
    
    begin(successEntries, originalEntries) {
        this.successEntries = successEntries;
        this.originalEntries = originalEntries;
        if(this.top) {
            this.top = false;
            const start = Date.now();//On récupère le timestamp actuel

            //Mise en place d'une boucle à intervales de 1 seconde
            this.interval = setInterval(() => {
                this.time = Date.now() - start;//stockage du temps passé entre le lancement de la partie et le tour en cours
                this.sec++;
                if(this.sec >= 60) {
                    this.min++;
                    this.sec = 0;
                }
                //On fait avancer la barre de progression dont l'id est "progresseBar"
                $('#progresseBar').css('width', (100/(this.limit*60))*Math.floor(this.time/1000)+"%");
                this.end();
            }, 1000);
        }
    },

    end() {
        if(this.min == this.limit) {
            clearInterval(this.interval);//On arrête la boucle à intervales
            $('.cards').off(); //On retire l'event Click de toute les cartes de jeux
            alert("C'est une défaite..\n Le temps est écoulé..\n C'est vraiment pas de chance !");
        }
        if(this.successEntries == this.originalEntries) {
            clearInterval(this.interval);
            alert("C'est une victoire !!\nEt ça en seulement "+this.min+" minutes et "+this.sec+" secondes !");
            let username = prompt("Quel est ton nom ?");//On récupère le nom du joueur
            
            //Requête AJAX Post
            //paramètre 1: url que l'on appelle
            //paramètre 2: tableau de donnée que l'on envoie (format JSON)
            $.post('/?p=game.createScore', {username:username, timer: this.time})
                .done(function(data) {
                    alert(data);
                    document.location.reload(true);// Rechargement de la page
                })
                .fail(function(error) {
                    if(error.status == 404) {
                        alert("Une erreur s'est produite,\n Feuille de score introuvable !");
                    }
                    console.log(error);
            });
        }
    }
}