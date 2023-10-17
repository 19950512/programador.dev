<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

@include('Layout.Header.Header')

<main>
    <div>
        <h1>Jiu-Jitsu | Five Rounds | Escola de Lutas | Marau -RS</h1>

        <div style="display: block; width: 100%; margin: auto; box-sizing:border-box; padding: 1rem">
            <div class="splide" role="group" >
                <div class="splide__track">
                      <ul class="splide__list"></ul>
                </div>
              </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
</main>

@include('Layout.Footer.Footer')
<style>
    .splide__slide__container{
        height: 80vh;
    }
</style>

<script>
    function htmlDecode(input) {
        let doc = new DOMParser().parseFromString(input, "text/html");
        return doc.documentElement.textContent;
    }
    const imagens = JSON.parse(htmlDecode('{{ $imagens }}'));
    document.addEventListener( 'DOMContentLoaded', function() {

        for(i in imagens){

            var li = document.createElement("li");
            li.className = "splide__slide";
            document.querySelector(".splide__list").appendChild(li);

            var div = document.createElement("div");
            div.style = "width: 100vw; height: 80vh; position: relative; overflow: hidden; display: block;";
            li.appendChild(div);

            var img = document.createElement("img");
            img.style = "position: absolute; object-fit:cover; width: 100%; height: 100%"
            img.className = "splide__slide__image";
            img.src = `/jiujitsu/${imagens[i]}`;
            div.appendChild(img);
        }

      var splide = new Splide( '.splide' );
      splide.mount();
    });
</script>