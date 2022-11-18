<template>
    <app-layout>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                <div style="margin-bottom: 5%">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-aling: center; margin-bottom: 30px">{{categoria}}</h2>

                    <form action="/crearInmueble" @submit.prevent="crearProducto">

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Titulo:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.titulo" >

                        <br><hr> <br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Descripcion:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.descripcion" >

                        <br><hr><br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lote:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.lote" >

                        <br><hr> <br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sector:</h2>
                        <select style="width: 95%; margin-right: 2%; margin-left: 2%"
                                class="form-control" v-model="form.id_sector" >
                            <option v-for="sec in sectores" :key="sec.id" :value="sec.id">{{sec.titulo}}</option>
                        </select>

                        <br><hr> <br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Imagenes:</h2>
                        <p style="margin-bottom: 20px">Se puede seleccionar mas de una</p>

                        <div class="row">

                            <img v-for="(imagen, key) in form.foto1" style="width: 250px; margin-right: 100px"
                                 :src="imagen" class="img-thumbnail">
                        </div>
                        <input type="file" @change="establecerFoto1" accept="image/*" style="margin-bottom: 20px"/>

                        <br><hr> <br>


                        <div class="col">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estado:</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="form.estado" value="0" name="pago">
                                <label class="form-check-label letraGrande">
                                    Alquiler
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" v-model="form.estado" name="pago" value="1">
                                <label class="form-check-label letraGrande">
                                    Venta
                                </label>
                            </div>
                        </div>


                        <br><hr><br>

                        <i class="fa fa-instagram"></i>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Precio:</h2>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon12">$</span>
                            </div>
                            <input v-model="form.precio" type="number" class="form-control" >
                        </div>

                        <br><hr><br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cantidad de Pisos:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="number"   class="form-control" v-model="form.pisos" >

                        <br><hr><br>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cantidad de Dormitorios:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.dormitorios" >

                        <br><hr><br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cantidad de Ambientes:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.ambientes" >

                        <br><hr><br>

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cantidad de Baños:</h2>
                        <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="form.banos" >

                        <br><hr><br>

                        <i class="fa fa-instagram"></i>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Superficie Total:</h2>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Mtrs Cuadrados</span>
                            </div>
                            <input v-model="form.superficie_total" type="number" class="form-control" >
                        </div>

                        <br><hr><br>

                        <div class="col">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pileta:</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="form.pileta" value="1" name="si1">
                                <label class="form-check-label letraGrande">
                                    Si
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" v-model="form.pileta" name="si1"  value="0">
                                <label class="form-check-label letraGrande">
                                    No
                                </label>
                            </div>
                        </div>

                        <br><hr><br>

                        <div class="col">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Parilla:</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="form.parilla" value="1" name="si2">
                                <label class="form-check-label letraGrande">
                                    Si
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" v-model="form.parilla" name="si2" value="0">
                                <label class="form-check-label letraGrande" >
                                    No
                                </label>
                            </div>
                        </div>

                        <br><hr><br>

                        <div class="col">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jardin:</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" v-model="form.jardin" value="1" name="si3">
                                <label class="form-check-label letraGrande">
                                    Si
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" v-model="form.jardin" name="si3" value="0">
                                <label class="form-check-label letraGrande">
                                    No
                                </label>
                            </div>
                        </div>

                        <br><hr><br>

                        <button class="btn btn-success" @click="guardarPublicacion">Guardar Publicacion</button>
                        <h2 v-if="this.listo == 1" style="text-align: center; color: darkgreen"> Se Creo exitosamente la publicacion </h2>
                    </form>
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
                        <h1 style="text-align: center; font-size: 27px">Debes completar todos los campos.</h1>
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
    name: "CrearInmueble",
    props: ['categoria','id','sectores'],
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
                precio: '',
                estado: '',
                descripcion: '',
                id_categoria: this.id,
                foto1: [],
                id_sector: '',
                numero: '',
                lote: '',
                pisos: '',
                dormitorios: '',
                ambientes: '',
                banos: '',
                superficie_total: '',
                pileta: '',
                parilla: '',
                jardin: ''
            }
        }
    },
    methods:
        {

            crearProducto()
            {
                var textos = 'Debe completer:';
                if (this.form.titulo == '') {
                    textos = textos + ' Titulo -';
                    this.texto = textos;
                }
                if (this.form.descripcion == '') {
                    textos = textos + ' Descripcion -';
                    this.texto = textos;
                }
                if (this.form.lote == '') {
                    textos = textos + ' Lote -';
                    this.texto = textos;
                }
                if (this.form.id_sector == '') {
                    textos = textos + ' Sector -';
                    this.texto = textos;
                }
                if (this.form.foto1 == []) {
                textos = textos + ' Fotos';
                    this.texto = textos;
               }
                if (this.form.estado == '') {
                    textos = textos + ' Estado -';
                    this.texto = textos;
                }
                if (this.form.precio == '') {
                    textos = textos + ' Precio -';
                    this.texto = textos;
                }
                if (this.form.pisos == '') {
                    textos = textos + ' Pisos -';
                    this.texto = textos;
                }
                if (this.form.dormitorios == '') {
                    textos = textos + ' Dormitorios -';
                    this.texto = textos;
                }
                if (this.form.ambientes == '') {
                    textos = textos + ' Ambientes -';
                    this.texto = textos;
                }
                if (this.form.banos == '') {
                    textos = textos + ' Baños -';
                    this.texto = textos;
                }
                if (this.form.superficie_total == '') {
                    textos = textos + ' Superficie -';
                    this.texto = textos;
                }
                if (this.form.pileta == '') {
                    textos = textos + ' Pileta -';
                    this.texto = textos;
                }
                if (this.form.parilla == '') {
                    textos = textos + ' Parilla -';
                    this.texto = textos;
                }
                if (this.form.jardin == '') {
                    textos = textos + ' Jardin -';
                    this.texto = textos;
                }
                if (textos == 'Debe completer:') {
                    this.$inertia.post('/productos', this.form);
                    $('#ModalPublicar').modal();
                }
                else {
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
