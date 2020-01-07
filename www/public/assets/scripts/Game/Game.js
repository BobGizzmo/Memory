const Game = {

    field: null,
    progressBarContainer: null,

    start(field, progressBarContainer) {
        this.field = field;
        this.progressBarContainer = progressBarContainer;
        this.include('game/class/Card.js');
        this.include('game/class/Timer.js');
        this.include('game/class/Ascerts.js');
        this.play();
    },

    include(file) {
        //Inclus une balise script dans à la fin de la balise body dy HTML
        //A personnaliser selon votre structure de fichiers
        $("body").append("<script src='/assets/scripts/"+file+"'></script>");
    },

    play() {
        //Requête AJAX Get
        $.ajax('/?p=game.getImages')
        .done((data) => {
            const response = JSON.parse(data);//On transforme la réponse que nous a renvoyé php en tableau JSON
            const cards = []//Tableau dans lequel nous stockerons toutes les images

            //Génération des cartes
            response.forEach((e, id) => {
                let card = new Card(id+'-1', e.src);
                let copyCard = new Card(id+'-2', e.src);

                cards.push(card, copyCard);
            });
            this.generate(cards, this.field);//Génération du terrain de jeu
        })
        .fail(function(error) {
            if(error.status == 404) {
                alert("Une erreur s'est produite,\n jeu de carte introuvable");
            }
        });
    },

    generate(cards) {
        cards.forEach((card, id) => {
            this.field.append(card.generate(id));//Inclusion de chaque carte dans l'objet HTML contenu dans this.field
        })
        this.shuffleElements($('.cards'));//Mélange des cartes
    
        $('.cards').click(function(card) {
            id = $(card.currentTarget).attr('id');//Récupération de l'id la carte sur laquelle on a cliqué
            dataId= $(card.currentTarget).data('id');//Récupération de l'attribut data-id
            card = cards[id];//Récupération de l'objet Card concerné
            //Appelle de la méthode check() de l'objet Game (/assets/scripts/Game/class/Ascerts.js)
            Ascerts.check(card, $('#'+id), dataId);
            //Appelle de la méthode begin() de l'objet Timer (/assets/scripts/Game/class/Timer.js)
            Timer.begin(Ascerts.successCards.length, cards.length/2);
        });
        //Mise en place de la barre de chargement
        this.getProgressBar();
    },

    shuffleElements($cards) {
        let i, index1, index2, temp_val;
    
        let count = $cards.length;//On récupère le nombre d'entrée du tableau "$cards"
        let $parent = $cards.parent();//On récupère l'objet HTML parent de nos cartes
        let shuffled_array = [];
    
    
        //On remplit notre tableau shuffled_array avec des index compris entre 0 et le nombre de nos cartes
        for (i = 0; i < count; i++) {
            shuffled_array.push(i);
        }
    
        // On mélange notre tableau d'index
        for (i = 0; i < count; i++) {
            //On prend un index au hasard entre 0 et la taille de notre tableau "$cards"
            index1 = (Math.random() * count) | 0;
            index2 = (Math.random() * count) | 0;
            
            //On inverse les contenu de shuffled_array[index1] et shuffled_array[index2]
            temp_val = shuffled_array[index1];
            shuffled_array[index1] = shuffled_array[index2];
            shuffled_array[index2] = temp_val;
        }
    
        // On applique le mélange dans la page
        $cards.detach();
        for (i = 0; i < count; i++) {
            $parent.append( $cards.eq(shuffled_array[i]) );
        }
    },

    getProgressBar() {
        this.progressBarContainer.append('<div id="progresseBar"></div>');
    }
}