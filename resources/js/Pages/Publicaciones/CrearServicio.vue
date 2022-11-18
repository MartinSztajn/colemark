<template>
    <app-layout>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                <div style="margin-bottom: 5%">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-aling: center; margin-bottom: 30px">{{categoria}}</h2>

                    <form action="/crearServicio" @submit.prevent="crearProducto">

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Titulo:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.titulo" >

                        <br><hr> <br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Imagenes:</h2>
                        <p style="margin-bottom: 20px">Se puede seleccionar mas de una</p>

                        <div class="row">

                            <img v-for="(imagen, key) in form.foto1" style="width: 250px; margin-right: 100px"
                                 :src="imagen" class="img-thumbnail">
                        </div>
                        <input multiple type="file" @change="establecerFoto1" accept="image/*" style="margin-bottom: 20px"/>

                        <br><hr><br>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nombre:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.nombre" >

                        <br><hr><br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Celular:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.celular" >

                        <br><hr> <br>


                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comentarios:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.descripcion" >
                        <br><hr> <br>


                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Direccion:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.direccion" >

                        <br><hr> <br>

                        <button class="btn btn-success" @click="guardarPublicacion">Guardar Publicacion</button>
                        <h2 v-if="this.listo == 1" style="text-align: center; color: darkgreen"> Se Creo exitosamente la publicacion </h2>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal  fade"  id="ModalPublicar" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-left: 25%; margin-top: 3%">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg></button>
                    <div class="modal-body">
                        <h1 style="text-align: center; font-size: 40px">¡Se realizo la publicacion!</h1>
                        <h1 style="text-align: center; font-size: 27px">Ya esta visible para los demas usuarios.</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" style="position:center; margin-top: 30px; margin-left: 40%; margin-bottom: 30px;" width="120" height="120" fill="green" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>
                        <h1 style="text-align: center; font-size: 27px; margin-bottom: 30px;">Puedes ver otras publicaciones.</h1>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal  fade"  id="ModalFalta" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="margin-left: 25%; margin-top: 3%">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg></button>
                    <div class="modal-body">
                        <h1 style="text-align: center; font-size: 40px; margin-bottom: 20px">¡No pudo cargarse la Publicacion!</h1>
                        <h1 style="text-align: center; font-size: 27px">{{this.texto}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>

</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import Button from "@/Jetstream/Button";

export default {
    name: "CrearServicio",
    props: ['categoria','id'],
    components: {
        Button,
        AppLayout,
        Welcome,
    },
    data()
    {
        return{
            listo: 0,
            ver: 1,
            texto: '',
            form:{
                titulo: '',
                descripcion: '',
                id_categoria: 0,
                foto1: [],
                nombre: '',
                direccion: '',
                celular: ''
            }
        }
    },
    methods:
        {
            cambiarCategoria(num){
                this.ver = num;
                alert(this.ver);
            },
            crearProducto()
            {
                var textos = 'Debe completer:';
                if (this.form.titulo == '') {
                    textos = textos + ' Titulo -';
                }
                if (this.form.celular == '') {
                    textos = textos + ' Celular -';
                }
                if (this.form.descripcion == '') {
                    textos = textos + ' Descripcion -';
                }
                if (this.form.nombre == '') {
                    textos = textos + ' Nombre -';
                }
                if (this.form.direccion == '') {
                    textos = textos + ' Direccion -';
                }
                if (this.form.foto1 == []) {
                    textos = textos + ' Fotos';
                }
                if (textos == 'Debe completer:') {
                    this.$inertia.post('/crearServicio', this.form);
                    $('#ModalPublicar').modal();
                }
                else {
                    this.texto = textos;
                    $('#ModalFalta').modal();
                }
            },
            establecerFoto1(e) {
                let file = e.target.files[0];
                let reader = new FileReader();

                reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                    this.form.foto1.push(reader.result);
                }
                reader.readAsDataURL(file);
            },
        }
}
</script>
