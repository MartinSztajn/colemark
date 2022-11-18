<template>
    <inicio-layout>
        <header class="shadow" style="background-color: #A9CCFF">
            <div class="celu">
                <div class="scrollmenu">
                    <a v-for="cat in categorias" :key="cat.id" :href="'/buscarCategoria/' + cat.titulo">{{cat.titulo}}</a>
                </div>
            </div>
            <div class="compu">
                <div style="display: flex; justify-content: center; padding-top: 17px; text-align: center; position: center;">
                    <div v-for="cat in categorias" :key="cat.id" style="text-align: center; position: center;">
                        <button  @click="buscarCategoria(cat.titulo)"  type="submit" class="button"  style="background-color: #3d107b; border-color: white; padding: 0.35rem 0.75rem; float: left; margin-right: 10px; ">
                            {{cat.titulo}}
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div style="margin: 3%">
            <h1 style="text-align: center; font-size: 70px">La Cole Market</h1>
            <h3 style="font-family: 'Brush Script MT', cursive;  text-align: center; font-size: 40px">El mercado mas grande de la comunidad.</h3>


            <div style="width: 100%; margin: 2%">
                <button onclick="location.href='/login'" class="blob-btn" style="width: 35%; margin-left: 12%; font-size: 28px; height: 100px">
                    Ingresa
                    <span class="blob-btn__inner" style="background-color: white">
                          <span class="blob-btn__blobs">
                            <span class="blob-btn__blob"></span>
                            <span class="blob-btn__blob"></span>
                            <span class="blob-btn__blob"></span>
                            <span class="blob-btn__blob"></span>
                          </span>
                        </span>
                </button>
                <button onclick="location.href='/register'" class="blob-btn" style="width: 35%; margin-left: 2%; font-size: 28px; height: 100px">
                    Registrate
                    <span class="blob-btn__inner" style="background-color: white">
      <span class="blob-btn__blobs">
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
      </span>
    </span>
                </button>

            </div>

            <div style="margin-top: 1%; width: 100%; float: left; margin-bottom: 2%">
                <video class="videoClass"  style="margin-top: 1%; float: left; border-radius: 7%; margin-left: 3%" autoplay loop muted>
                    <source src="images/VideoIzq.mp4" type="video/mp4" />
                </video>
                <video class="videoClass" style="margin: 1%; float: left; border-radius: 7%;" autoplay loop muted>
                    <source src="images/VideoPantalla2.mp4" type="video/mp4" />
                </video>
            </div>

            <a href="mailto:lacolemarket@gmail.com?subject=Infomación%20Publicidad">
                <img  src="images/Contactanos.jpg" style="width: 95%; margin-left: 3%; margin-bottom: 2%">
            </a>

            <div style="margin: 1%">
                <button onclick="location.href='/guardadas'" class="blob-btn" style="background-color: #00b3ee; margin-left: 3%">
                    Guardados
                    <span class="blob-btn__inner">
      <span class="blob-btn__blobs">
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
        <span class="blob-btn__blob"></span>
      </span>
    </span>
                </button>
                <button onclick="location.href='/crearPublicacion'" class="blob-btn">
                    Publicar
                    <span class="blob-btn__inner">
      <span class="blob-btn__blobs"><span class="blob-btn__blob"></span><span class="blob-btn__blob"></span><span class="blob-btn__blob"></span><span class="blob-btn__blob"></span></span>
    </span>
                </button>
                <button onclick="location.href='/publicadas'" class="blob-btn">
                    Publicados
                    <span class="blob-btn__inner">
                      <span class="blob-btn__blobs">
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                      </span>
                    </span>
                </button>
                <button onclick="location.href='/buscarCategoria/Inmuebles'" class="blob-btn">
                    Comprar
                    <span class="blob-btn__inner">
                      <span class="blob-btn__blobs">
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                        <span class="blob-btn__blob"></span>
                      </span>
                    </span>
                </button>

                <br/>
            </div>
        </div>
        <footer class="site-footer" style="width: 100%; float: right; margin-top: 50px">
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <h6>Nosotros</h6>
                        <p class="text-justify" style="margin: 20px"></p>Somos el mercado de la comunidad. Podes vender, comprar todo lo que necesites en un ambiente de confianza, calidad y seguridad.     </div>

                    <div class="col-xs-6 col-md-7">
                        <h6 style="margin-bottom: 20px">Categorias</h6>
                        <ul class="footer-links" v-for="cat in categorias" :key="cat.id">
                            <li><button @click="buscarCategoria(cat.titulo)"> {{cat.titulo}}</button></li>
                        </ul>
                    </div>
                    <hr style="width: 90%; margin-left:5%; margin-bottom:20px; margin-top:20px;">
                    <div class="col-xs-12 col-md-12">
                        <p style="text-align: center">Copyright &copy; 2022 La Cole Market S.R.L</p>
                    </div>
                </div>
            </div>
        </footer>

    </inicio-layout>
</template>


<script>
import InicioLayout from '@/Layouts/InicioLayout'
import Welcome from '@/Jetstream/Welcome'
import Button from "@/Jetstream/Button";

export default {
    name: "Inicio",
    props: ['categorias'],
    components: {
        Button,
        InicioLayout,
        Welcome
    },
    data()
    {
        return{
            listo: 0,
            titulo: '',
            buscador: '',

            form:{
            }
        }
    },
    methods:
        {
            buscarCategoria(titulo)
            {
                this.$inertia.get('/buscarCategoria/' + titulo);
            },
        }
}
</script>


<style scoped>
body{
    font-family: "Open Sans", Helvetica, Arial, sans-serif;
}
div.scroll {
    margin: 4px 4px;
    padding: 4px;
    background-color: #08c708;
    width: 300px;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}

.button {
    display: inline-block;
    padding: 15px 25px;
    font-size: 16px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    color: #fff;
    background-color: #4CAF50;
    border: none;
    border-radius: 7px;
    box-shadow: 0 6px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
    background-color: #3e8e41;
    box-shadow: 0 6px #666;
    transform: translateY(4px);
}



/* fonts  */
@import url('https://fonts.googleapis.com/css?family=Abel|Aguafina+Script|Artifika|Athiti|Condiment|Dosis|Droid+Serif|Farsan|Gurajada|Josefin+Sans|Lato|Lora|Merriweather|Noto+Serif|Open+Sans+Condensed:300|Playfair+Display|Rasa|Sahitya|Share+Tech|Text+Me+One|Titillium+Web');

body {
    background: #DFC2F2;
    background-image: linear-gradient( 135deg, #CE9FFC 10%, #7367F0 100%);
    background-attachment: fixed;
    background-size: cover;
}

/* 	Product details  */
.product-details {
    position: relative;
    text-align: left;
    overflow: hidden;
    padding: -54px;
    height: 100%;
    float: left;
    width: 40%;

}

/* 	Product Name */
.container .product-details h1{
    font-family: 'Old Standard TT', serif;
    display: inline-block;
    position: relative;
    font-size: 34px;
    color: #344055;
    margin: 0;

}




/*Product Rating  */
.hint-star {
    display: inline-block;
    margin-left: 0.5em;
    color: gold;
    width: 50%;
}


/* The most important information about the product */
.container .product-details > p {
    font-family: 'Farsan', cursive;
    text-align: center;
    font-size: 20px;
    color: #7d7d7d;

}

/* control */

.control{
    position: absolute;
    bottom: 2%;
    left: 10%;

}
/* the Button */
.btn {
    transform: translateY(0px);
    transition: 0.3s linear;
    background: #49C608;
    border-radius: 5px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    outline: none;
    border: none;
    color: #eee;
    padding: 0;
    margin: 0;

}

.btn:hover{transform: translateY(-4px);}

.btn span {
    font-family: 'Farsan', cursive;
    transition: transform 0.3s;
    display: inline-block;
    padding: 10px 20px;
    font-size: 1.2em;
    margin:0;

}


.btn .price {
    transform: translateX(-10%); padding-right: 15px;
}

/* the Icon */
.btn .shopping-cart {
    transform: translateX(-100%);
    position: absolute;
    background: #333;
    z-index: 1;
    left: 0;
    top: 0;
}

/* buy */
.btn .buy {z-index: 3; font-weight: bolder;}

.btn:hover .price {transform: translateX(-110%);}

.btn:hover .shopping-cart {transform: translateX(0%);}



/* product image  */
.product-image {
    transition: all 0.3s ease-out;
    display: inline-block;
    position: relative;
    overflow: hidden;
    height: 350px;
    width: 60%;
    display: inline-block;
}

.container img {width: 100%;height: 100%;}

.info {
    background: rgba(27, 26, 26, 0.9);
    font-family: 'Farsan', cursive;
    transition: all 0.3s ease-out;
    transform: translateX(-100%);
    position: absolute;
    line-height: 1.9;
    text-align: left;
    font-size: 120%;
    cursor: no-drop;
    color: #FFF;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}

.info h2 {text-align: center}
.product-image:hover .info{transform: translateX(0);}

.info ul li{transition: 0.3s ease;}
.info ul li:hover{transform: translateX(50px) scale(1.3);}

.product-image:hover img {transition: all 0.3s ease-out;}
.product-image:hover img {transform: scale(1.2, 1.2);}


galeria {
    height: calc( 300px + 3em);
    width: 260px;
    margin:1em auto;
    border: 1px solid #555;
    position: relative;
}

.galeria img {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 3s;
}

.galeria input[type=radio] {
    position: relative;
    bottom: calc(-300px - 1.5em);
    left: .5em;
}

.galeria input[type=radio]:nth-of-type(1):checked ~ img:nth-of-type(1) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(2):checked ~ img:nth-of-type(2) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(3):checked ~ img:nth-of-type(3) {
    opacity: 1;
}

.galeria input[type=radio]:nth-of-type(4):checked ~ img:nth-of-type(4) {
    opacity: 1;
}



@media (min-width: 750px) {
    .shadow{
        height: 80px;
    }
    .celu{
        display: none;
    }
    .videoClass{
        width: 47%;
    }
    .fotoClass{
        width: 320px;
        height: 320px;
    }
    .container{
        box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
        background: rgba(255, 255, 255, 0.90);
        text-align: center;
        border-radius: 5px;
        overflow: hidden;
        margin: 20px;
        height: 350px;
        width: 450px;
    }
    .blob-btn {
        z-index: 1;
        position: relative;
        padding: 10px 20px;
        text-align: center;
        text-transform: uppercase;
        color: #0505a9;
        font-size: 20px;
        font-weight: bold;
        background-color: transparent;
        outline: none;
        border: none;
        transition: color 0.5s;
        cursor: pointer;
        border-radius: 30px;
        margin: 1%;
        width: 22%;
        height: 150px;
    }
}
@media (max-width: 749px) {
    .blob-btn {
        z-index: 1;
        position: relative;
        padding: 10px 20px;
        margin-bottom: 10px;
        text-align: center;
        text-transform: uppercase;
        color: #0505a9;
        font-size: 12px;
        font-weight: bold;
        background-color: transparent;
        outline: none;
        border: none;
        transition: color 0.5s;
        cursor: pointer;
        border-radius: 30px;
        width: 45%;
        height: 150px;
    }
    .compu{
        display: none;
    }
    div.scrollmenu {
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
    }

    div.scrollmenu a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }

    div.scrollmenu a:hover {
        background-color: #777;
    }
    .videoClass{
        width: 90%;
        margin-left: 5%;
    }
    .fotoClass{
        margin-left: 10px;
        width: 44%;
        float: left;
    }
    .container{
        box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
        background: rgba(255, 255, 255, 0.90);
        text-align: center;
        border-radius: 5px;
        overflow: hidden;
        margin: 20px;
        height: 300px;
        width: 350px;
    }
}

.buttons {
    margin-top: 15px;
    text-align: center;
    border-radius: 30px;
}

.blob-btn:before {
    content: "";
    z-index: 1;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border: 2px solid #0505a9;
    border-radius: 30px;
}

.blob-btn:after {
    content: "";
    z-index: -2;
    position: absolute;
    left: 3px;
    top: 3px;
    width: 100%;
    height: 100%;
    transition: all 0.3s 0.2s;
    border-radius: 30px;
}
.blob-btn:hover {
    color: #ffffff;
    border-radius: 30px;
}
.blob-btn:hover:after {
    transition: all 0.3s;
    left: 0;
    top: 0;
    border-radius: 30px;
}
.blob-btn__inner {
    z-index: -1;
    overflow: hidden;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 30px;
    background: #A9CCFF;
}
.blob-btn__blobs {
    position: relative;
    display: block;
    height: 100%;
    filter: url("#goo");
}
.blob-btn__blob {
    position: absolute;
    top: 2px;
    width: 25%;
    height: 100%;
    background: #0505a9;
    border-radius: 100%;
    transform: translate3d(0, 150%, 0) scale(1.7);
    transition: transform 0.45s;
}
@supports (filter: url("#goo")) {
    .blob-btn__blob {
        transform: translate3d(0, 150%, 0) scale(1.4);
    }
}
.blob-btn__blob:nth-child(1) {
    left: 0%;
    transition-delay: 0s;
}
.blob-btn__blob:nth-child(2) {
    left: 30%;
    transition-delay: 0.08s;
}
.blob-btn__blob:nth-child(3) {
    left: 60%;
    transition-delay: 0.16s;
}
.blob-btn__blob:nth-child(4) {
    left: 90%;
    transition-delay: 0.24s;
}
.blob-btn:hover .blob-btn__blob {
    transform: translateZ(0) scale(1.7);
}
@supports (filter: url("#goo")) {
    .blob-btn:hover .blob-btn__blob {
        transform: translateZ(0) scale(1.4);
    }
}


.row{
    margin-left: 0px;
    margin-right: 0px;
    text-align: center;
}
.site-footer
{
    background-color:#26272b;
    padding:20px 0 20px;
    font-size:15px;
    line-height:20px;
    color:#737373;
}
.site-footer hr
{
    border-top-color:#bbb;
    opacity:0.5
}
.site-footer hr.small
{
    margin:20px 0
}
.site-footer h6
{
    color:#fff;
    font-size: 19px;
    margin-bottom: 10px;
    text-transform:uppercase;
    margin-top:5px;
    letter-spacing:2px
}
.site-footer a
{
    color:#737373;
}
.site-footer a:hover
{
    color:#3366cc;
    text-decoration:none;
}
.footer-links
{
    width: 20%;
    float: left;
    padding-left:0;
    list-style:none
}
.footer-links li
{
    display:block
}
.footer-links a
{
    color:#737373
}
.footer-links a:active,.footer-links a:focus,.footer-links a:hover
{
    color:#3366cc;
    text-decoration:none;
}
.footer-links.inline li
{
    display:inline-block
}
.site-footer .social-icons
{
    text-align:right
}
.site-footer .social-icons a
{
    width:40px;
    height:40px;
    line-height:40px;
    margin-left:6px;
    margin-right:0;
    border-radius:100%;
    background-color:#33353d
}
.copyright-text
{
    margin:0
}
@media (max-width:991px)
{
    .site-footer [class^=col-]
    {
        margin-bottom:30px
    }
}
@media (max-width:767px)
{
    .site-footer
    {
        padding-bottom:0
    }
    .site-footer .copyright-text,.site-footer .social-icons
    {
        text-align:center
    }
}
.social-icons
{
    padding-left:0;
    margin-bottom:0;
    list-style:none
}
.social-icons li
{
    display:inline-block;
    margin-bottom:4px
}
.social-icons li.title
{
    margin-right:15px;
    text-transform:uppercase;
    color:#96a2b2;
    font-weight:700;
    font-size:13px
}
.social-icons a{
    background-color:#eceeef;
    color:#818a91;
    font-size:16px;
    display:inline-block;
    line-height:44px;
    width:44px;
    height:44px;
    text-align:center;
    margin-right:8px;
    border-radius:100%;
    -webkit-transition:all .2s linear;
    -o-transition:all .2s linear;
    transition:all .2s linear
}
.social-icons a:active,.social-icons a:focus,.social-icons a:hover
{
    color:#fff;
    background-color:#29aafe
}
.social-icons.size-sm a
{
    line-height:34px;
    height:34px;
    width:34px;
    font-size:14px
}
.social-icons a.facebook:hover
{
    background-color:#3b5998
}
.social-icons a.twitter:hover
{
    background-color:#00aced
}
.social-icons a.linkedin:hover
{
    background-color:#007bb6
}
.social-icons a.dribbble:hover
{
    background-color:#ea4c89
}
@media (max-width:767px)
{
    .social-icons li.title
    {
        display:block;
        margin-right:0;
        font-weight:600
    }
}




</style>
