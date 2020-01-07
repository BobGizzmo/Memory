class  Card {

    constructor(id, realSrc) {
        this.dataId = id;
        this.realSrc = realSrc;
        this.defaultSrc = '/assets/images/pointInterro.png';
        this.essai = 1;
    }

    generate(id) {
        return '<img id='+id+' class="cards" data-id='+this.dataId+' src="'+this.defaultSrc+'" alt="Image du jeux">'
    }

    update(essai) {
        return essai == 2 ? this.defaultSrc : this.realSrc;
    }
}