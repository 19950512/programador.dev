<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

@include('Layout.Header.Header')

<style>
    .splide {
      margin: 0 auto;
    }

    .thumbnails {
      display: flex;
      margin: 1rem auto 0;
      padding: 0;
      justify-content: center;
    }

    .thumbnail {
      width: 70px;
      height: 70px;
      overflow: hidden;
      list-style: none;
      margin: 0 0.2rem;
      cursor: pointer;
      opacity: 0.3;
    }

    .thumbnail.is-active {
      opacity: 1;
    }

    .thumbnail img {
      width: 100%;
      height: auto;
    }
</style>
<main>
    <div>
        <h1>Jiu-Jitsu | Five Rounds | Escola de Lutas | Marau -RS</h1>


        <section id="main-slider" class="splide" style="height: 70vh;" aria-label="My Awesome Gallery">
            <div class="splide__track">
                <ul class="splide__list"></ul>
            </div>
        </section>
        <ul id="thumbnails" class="thumbnails"></ul>

    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
</main>

@include('Layout.Footer.Footer')
<script>
    const imagens = JSON.parse(htmlDecode('{{ $imagens }}'));

    for(i in imagens){

        /* THUMB */
        var li = document.createElement("li");
        li.className = "thumbnail";
        document.querySelector(".thumbnails").appendChild(li);

        /*var div = document.createElement("div");
        div.style = "width: 100vw; height: 80vh; position: relative; overflow: hidden; display: block;";
        li.appendChild(div);*/

        var img = document.createElement("img");
        /*img.style = "position: absolute; object-fit:cover; width: 100%; height: 100%"
        img.className = "splide__slide__image";*/
        img.src = `/jiujitsu/${imagens[i]}`;
        li.appendChild(img);

        /* GALERIA */

        var li2 = document.createElement("li");
        li2.className = "splide__slide";
        document.querySelector(".splide__list").appendChild(li2);

        var img2 = document.createElement("img");
        /*img.style = "position: absolute; object-fit:cover; width: 100%; height: 100%"
        img.className = "splide__slide__image";*/
        img2.src = `/jiujitsu/${imagens[i]}`;
        li2.appendChild(img2);

    }

    function htmlDecode(input) {
        let doc = new DOMParser().parseFromString(input, "text/html");
        return doc.documentElement.textContent;
    }

    var splide = new Splide("#main-slider", {
        pagination: false,
        cover: true
      });

      var thumbnails = document.getElementsByClassName("thumbnail");
      var current;

      for (var i = 0; i < thumbnails.length; i++) {
        initThumbnail(thumbnails[i], i);
      }

      function initThumbnail(thumbnail, index) {
        thumbnail.addEventListener("click", function () {
          splide.go(index);
        });
      }

      splide.on("mounted move", function () {
        var thumbnail = thumbnails[splide.index];

        if (thumbnail) {
          if (current) {
            current.classList.remove("is-active");
          }

          thumbnail.classList.add("is-active");
          current = thumbnail;
        }
      });

      splide.mount();
    document.addEventListener( 'DOMContentLoaded', function() {

    });
</script>