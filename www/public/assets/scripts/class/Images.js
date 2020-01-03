class Image {

    constructor(images) {
        this.images = images;
        this.successCards = [];
        this.try = [];
    }

    generate(elements) {
        this.shuffleElements(elements);
    }

    checkCards(card) {
        let id = $(card).data('id');//On récupère la valeur de l'attribut "data-id" de l'objet sur lequel on a cliqué
        this.try.push(id);//On l'ajoute dans notre tableau d'essaie
        $(card).addClass('show')
        //Si 2 cartes ont été cliquées
        if(this.try.length == 2) {
            //Si les 2 cartes sont les mêmes
            let index = [];
            this.try.forEach(e => {
                index.push(e.split('-'));
            });
            /*On vérifie que les id soit les même mais que les index "-1, -2" soit bien différent pour eviter la validation par dbclick*/
            if(index[0][0] === index[1][0] && index[0][1] !== index[1][1]) {
                this.successCards.push(this.try);//On push la combinaison dans notre tableau "succesCards"
                //On retire la class show de nos cartes puis on désactive l'event "click" pour celles-ci
                $('img[data-id='+index[0][0]+'-1]').removeClass('show').off();
                $('img[data-id='+index[0][0]+'-2]').removeClass('show').off();
            }
            else {
                //On vérifie que les cartes n'ont pas déjà été validées
                if(this.successCards.indexOf(id) == -1) {
                    //Puis on attend 1 seconde (1000 millisecondes) pour remettre les ?
                    setTimeout(function() {
                        $('.show').attr('src', '/assets/images/pointInterro.png').removeClass('show');
                    }, 1000);
                }
            }
            this.try = [];//On vide le tableau "try"
        }
    }

    
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
    }
    
}