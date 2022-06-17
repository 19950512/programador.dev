<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Galeria</title>
        <script src="js/galeria.js"></script>
        <link rel="stylesheet" href="css/galeria.css"/>
        <style>
            body {
                margin: auto;
                background-color: lime;
            }
        </style>
    </head>
    <body>
        

        <div id="galeria_render" ></div>

        <script>
            const galeria = new Galeria({
                time: 2000,
                elemento_render: galeria_render,
                imagens: [
                    {
                        big:"imagens/1.png",
                        small:"imagens/1.png"
                    },
                    {
                        legenda:"Fuck You!",
                        big:"imagens/2.png",
                        small:"imagens/2.png"
                    },
                    {
                        big:"imagens/3.png",
                        small:"imagens/3.png"
                    },
                    /* {
                        big:"imagens/4.png",
                        small:"imagens/4.png"
                    },
                    {
                        big:"imagens/5.png",
                        small:"imagens/5.png"
                    },
                    {
                        big:"imagens/6.png",
                        small:"imagens/6.png"
                    },
                    {
                        big:"imagens/7.png",
                        small:"imagens/7.png"
                    },
                    {
                        big:"imagens/8.png",
                        small:"imagens/8.png"
                    },
                    {
                        big:"imagens/9.png",
                        small:"imagens/9.png"
                    },
                    {
                        big:"imagens/10.png",
                        small:"imagens/10.png"
                    },
                    {
                        big:"imagens/11.png",
                        small:"imagens/11.png"
                    },
                    {
                        big:"imagens/12.png",
                        small:"imagens/12.png"
                    }, */
                ],
                /*'mascara_miniatura': `<div class="galeria-miniatura"><img src="{{big}}" alt="{{algo}}" title="{{algo}}" /></div>`*/
            });
            galeria.init();
        </script>

    </body>
</html>