class Galeria {

    constructor(configuracoes = {}){

        this.configuracoes = configuracoes;
        if(typeof(configuracoes['elemento_render']) == 'string'){
            this.elemento_render = document.getElementById(configuracoes['elemento_render']);
        }
        if(typeof(configuracoes['elemento_render']) == 'object'){
            this.elemento_render = configuracoes['elemento_render'];
        }
        
        this.validacaoMensagem = this._validacao();

        if(this.validacaoMensagem !== true){
            console.error(this.validacaoMensagem);
            return;
        }

        this.autoplay = true;
        this.time = this.configuracoes['time'] || 5000;

        this.currentImagem = -1;
    }


    _validacao(){
        if(!this.elemento_render){
            return `O elemento para renderizar não foi informado ou não existe.`
        }

        if(typeof(this.configuracoes['imagens']) == 'undefined'){
            return 'Informe as imagens'
        }
        if(this.configuracoes['imagens'].lenght <= 0){
            return 'Informe uma lista de imagens.'
        }

        return true;
    }

    async _miniaturas(){

        let elemento_miniaturas_render = document.createElement('DIV');
        elemento_miniaturas_render.classList.add('galeria-miniaturas-render');
        
        let elemento_miniaturas = document.createElement('DIV');
        elemento_miniaturas.classList.add('galeria-miniaturas')

        for(let i in this.configuracoes['imagens']){
            let imagem = this.configuracoes['imagens'][i];

            if(typeof(this.configuracoes['mascara_miniatura']) !== 'undefined' && this.configuracoes['mascara_miniatura'] !== ''){

                elemento_miniaturas.innerHTML += this._replace({
                    '{{algo}}':imagem['legenda'] || '',
                    '{{big}}': imagem['big'] || '',
                    '{{small}}': imagem['small'] || '',
                }, this.configuracoes['mascara_miniatura']);

            }else{
                
                let miniatura = document.createElement('DIV');
                miniatura.classList.add('galeria-miniatura')
                miniatura.setAttribute('onclick', `galeria.index(${i});`);
                miniatura.innerHTML = `<img src="${imagem['small']}" alt="${imagem['legenda'] || ''}" title="${imagem['legenda'] || ''}"/>`;
                elemento_miniaturas.appendChild(miniatura);
            }
        }
        elemento_miniaturas_render.appendChild(elemento_miniaturas);
        this.elemento_render.appendChild(elemento_miniaturas_render)
    }

    _sleep(ms){
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    _mainSizeToggle(){

        let variableMainSize = '--mainSize';
        let valueMainSize = 'contain';
        if(getComputedStyle(document.documentElement).getPropertyValue(variableMainSize) == 'contain'){
            valueMainSize = 'cover';
        }
        document.documentElement.style.setProperty(variableMainSize, valueMainSize);
    }
    _replace(obj, retStr){
        for (var x in obj) {
            retStr = retStr.replace(new RegExp(x, 'g'), obj[x]);
        }
        return retStr;
    }

    _recalculoAlturaMiniaturas(){
        let alturaMiniaturas = (document.querySelector('.galeria_imagem_main').offsetHeight / 6) + 'px';
        document.documentElement.style.setProperty('--alturaMiniaturas', alturaMiniaturas);
    }
    _eventos(){

        window.addEventListener('resize', this._recalculoAlturaMiniaturas, true);
    }

    _imagemmain(){

        let imagem_main = document.createElement('DIV');
        imagem_main.classList.add('galeria_imagem_main');

        let imagem_main_legenda = document.createElement('DIV');
        imagem_main_legenda.classList.add('galeria_imagem_main_legenda');

        let imagem_main_play = document.createElement('BUTTON');
        imagem_main_play.classList.add('galeria_imagem_main_play');
        imagem_main_play.innerHTML = this.autoplay ? 'STOP' : 'PLAY';
        imagem_main_play.setAttribute('onclick', `galeria.autoplay = !galeria.autoplay; galeria._render(); this.innerHTML = this.innerHTML == 'STOP' ? 'PLAY' : 'STOP'`);
        //imagem_main_play.classList.add('galeria_imagem_main_play');
        

        imagem_main.appendChild(imagem_main_legenda);
        imagem_main.appendChild(imagem_main_play);
        this.elemento_render.appendChild(imagem_main);

        this._nextOrprevExists();
        this._render();
    }

    index(imagem = 0){

        if(typeof(this.configuracoes['imagens'][imagem]) !== 'undefined'){
            this.autoplay = false;
            document.querySelector('.galeria_imagem_main_play').innerHTML = 'PLAY';
            this.currentImagem = imagem;
            this._render();
        }else{
            console.log('Imagem não existe.');
        }

    }
    back(){
        this.autoplay = false;
        document.querySelector('.galeria_imagem_main_play').innerHTML = 'PLAY';
        this._nextOrprevExists(-1);
        this._render();
    }
    next(){
        this.autoplay = false;
        document.querySelector('.galeria_imagem_main_play').innerHTML = 'PLAY';
        this._nextOrprevExists();
        this._render();
    }

    _nextOrprevExists(num = 1){
        if(typeof(this.configuracoes['imagens'][this.currentImagem + num]) !== 'undefined'){
            this.currentImagem = this.currentImagem + num;
        }else{
            this.currentImagem = 0;
        }
    }

    async _render(){

        setTimeout(function(){

            // vamos selecionar a imagem miniatura que está na main
            let miniaturas = document.querySelector('.galeria-miniaturas').querySelectorAll('.galeria-miniatura');
            for(let i = 0; i < miniaturas.length; i++){

                if(i == galeria.currentImagem){
                    miniaturas[galeria.currentImagem].classList.add('galeria-miniatura-selected');
                }else{
                    miniaturas[i].classList.remove('galeria-miniatura-selected');
                }
            }

            if(galeria.currentImagem >= 5){
                document.querySelector('.galeria-miniaturas-render').scrollLeft += miniaturas[galeria.currentImagem].offsetWidth || 50;
            }else{
                document.querySelector('.galeria-miniaturas-render').scrollLeft = 0;
            }
            //miniaturas[this.currentImagem].classList.add('galeria-miniatura-selected');
        }, 100);


        let imagem = this.configuracoes['imagens'][this.currentImagem];
        document.querySelector('.galeria_imagem_main_legenda').innerHTML = '';
        document.querySelector('.galeria_imagem_main_legenda').style.backgroundColor = 'transparent';
        if(typeof(imagem['legenda']) !== 'undefined' && imagem['legenda'] !== ''){
            document.querySelector('.galeria_imagem_main_legenda').style.backgroundColor = 'rgba(0,0,0,.8)';
            document.querySelector('.galeria_imagem_main_legenda').innerHTML = this.configuracoes['imagens'][this.currentImagem]['legenda'] || '';
        }
        
        document.querySelector('.galeria_imagem_main').style.backgroundImage = "url('" + this.configuracoes['imagens'][this.currentImagem]['big'] || '' + "')";

        await this._sleep(this.time);

        if(this.autoplay == true){
            this._nextOrprevExists();
            this._render();
        }
    }

    init(){
        if(this.validacaoMensagem !== true){
            return console.error(this.validacaoMensagem)
        }

        this._eventos();

        this._imagemmain();

        // Vamos criar as miniaturas
        this._miniaturas();

        this._recalculoAlturaMiniaturas();
    }
}