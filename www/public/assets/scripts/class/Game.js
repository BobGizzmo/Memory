const Game = {
    successCards: [],
    cards:[],

    check(Card, $card, dataId) {
        src = Card.update(1);
        $card.attr("src", src);

        this.cards.push(dataId);//On l'ajoute dans notre tableau d'essaie
        $($card).addClass('show')
        //Si 2 cartes ont été cliquées
        if(this.cards.length == 2) {
            //Si les 2 cartes sont les mêmes
            let index = [];
            this.cards.forEach(e => {
                index.push(e.split('-'));
            });
            /*On vérifie que les id soit les même mais que les index "-1, -2" soit bien différent pour eviter la validation par dbclick*/
            if(index[0][0] === index[1][0] && index[0][1] !== index[1][1]) {
                this.successCards.push(this.cards);//On push la combinaison dans notre tableau "succesCards"
                //On retire la class show de nos cartes puis on désactive l'event "click" pour celles-ci
                $('img[data-id='+index[0][0]+'-1]').removeClass('show').off();
                $('img[data-id='+index[0][0]+'-2]').removeClass('show').off();
            }
            else {
                //On vérifie que les cartes n'ont pas déjà été validées
                if(this.successCards.indexOf(id) == -1) {
                    //Puis on attend 1 seconde (1000 millisecondes) pour remettre les ?
                    setTimeout(function() {
                        src = Card.update(2);
                        $('.show').attr('src', src);
                    }, 1000);
                }
            }
            this.cards = [];//On vide le tableau "try"
        }
    }
}