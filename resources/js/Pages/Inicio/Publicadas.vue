<template>
    <app-layout>
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



        <div class="py-12">
            <div style="margin-bottom: 5%">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tabla-publicaciones   v-for="pub in productos"  :key="pub.id" v-bind:pub="pub"  v-bind:id="pub.id" v-bind:categorias="categorias">
                    </tabla-publicaciones>
                    </tbody>
                </table>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Dormitorios</th>
                        <th scope="col">Superficie M2</th>
                        <th scope="col">Pisos</th>
                        <th scope="col">Baños</th>
                        <th scope="col">Ambientes</th>
                        <th scope="col">Jardin</th>
                        <th scope="col">Pileta</th>
                        <th scope="col">Parilla</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tabla-inmuebles   v-for="inm in inmuebles"  v-bind:pub="inm"  v-bind:id="inm.id" :key="inm.id">
                        </tabla-inmuebles>
                    </tbody>
                </table>
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

        <div class="modal  fade"  id="ModalquickView2" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg></button>
                    <div class="modal-body">
                        <div v-for="pre in fotos" :key="pre.id">
                            <img  :src="'/market/' + pre.path + '.jpg'"  style="width: 80%; position: center; margin: 10%">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import Button from "@/Jetstream/Button"
import tablaInmuebles from "@/Components/tablaInmuebles";
import tablaServicios from "@/Components/tablaServicios";
import tablaPublicaciones from "@/Components/tablaPublicaciones";


export default {
    name: "Publicadas",
    props: ['categorias','productos','inmuebles','servicios'],
    components: {
        tablaInmuebles,
        tablaPublicaciones,
        tablaServicios,
        Button,
        AppLayout,
        Welcome
    },
    data()
    {
        return{
            fotos: [],
            form:{
                id: '',
                cate: '',
            }
        }
    },
    methods:
        {
            deseaEliminar($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;
                $('#ModalquickView').modal();
            },
            buscarCategoria(titulo)
            {
                this.$inertia.get('/buscarCategoria/' + titulo);
            },
            guardarCategoria()
            {
                this.listo = 1;
                axios.post('/guardarCategoria/' + this.titulo);
            },
            borrarCategoria($id)
            {
                this.$inertia.post('/borrarCategoria/' + $id);
            },
            eliminarPublicacion(){
                this.$inertia.post('/eliminarPublicacion', this.form);
            },

            guardarPublicacion($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;

                this.$inertia.post('/guardarPublicacion', this.form);
            },
            quitarPublicacion($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;

                this.$inertia.post('/quitarPublicacion', this.form);
            },
            abrirModal2($fotos){
                this.fotos = $fotos;
                $('#ModalquickView2').modal();
            },
        }
}
</script>


<style scoped>
p{
    font-size: 15px;
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



/* 	Product details  */
.product-details {
    position: relative;
    text-align: left;
    overflow: hidden;
    padding: -54px;
    height: 350px;
    float: left;
    width: 40%;

}

/* 	Product Name */
.container h1{
    font-family: 'Old Standard TT', serif;
    position: relative;
    font-size: 34px;
    color: #F1F1F1;
    padding-top: 10px;
    padding-bottom: 10px;

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
    left: 22.5%;

}
/* the Button */
.btn {
    transform: translateY(0px);
    transition: 0.3s linear;
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

.container img {width: 100%;}

.info {
    background: #3d107b;
    font-family: 'Farsan', cursive;
    position: absolute;
    line-height: 1.9;
    text-align: left;
    font-size: 120%;
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


@media (max-width: 1200px) {

    .scrollmenu{
        width: 100%;
        height: 60px;
        white-space: nowrap;
        font-size: 14px;
        overflow-x: scroll;
    }
    #style-3::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar
    {
        width: 6px;
        background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar-thumb
    {
        background-color: #000000;
    }
}





.slider-container{
    height: 100%;
    width: 100%;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.menu {
    position: absolute;
    left: 0;
    z-index: 900;
    width: 100%;
    bottom: 0;
}

.menu label {
    cursor: pointer;
    display: inline-block;
    width: 16px;
    height: 16px;
    background: #fff;
    border-radius: 50px;
    margin: 0 .2em 1em;
}

.slide {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 100%;
    z-index: 10;
    padding: 8em 1em 0;
    background-size: cover;
    background-position: 50% 50%;
    transition: left 0s .75s;
}

[id^="slide"]:checked + .slide {
    left: 0;
    z-index: 100;
    transition: left .65s ease-out;
}

.slide-1 {
    background-image: url("https://source.unsplash.com/t7YycgAoVSw/1600x900");
}
.slide-2 {
    background-image: url("https://source.unsplash.com/11H1SSVcIxc/1600x900");
}
.slide-3 {
    background-image: url("https://source.unsplash.com/OlZ1nWLEEgM/1600x900");
}


@media (min-width: 750px) {
    .shadow{
        height: 80px;
    }
    .celu{
        display: none;
    }
}
@media (max-width: 749px) {
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

    .container{
        width: 90%;
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
