<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >

                <h1 style="text-align: center; font-size: 25px">Productos</h1>
                <div style="margin-bottom: 5%; margin-top: 2%">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fotos</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(pro,key) in productos">
                            <td>{{key + 1}}</td>
                            <td>{{pro.name}}</td>
                            <td>{{pro.nomCategoria}}</td>
                            <td>{{pro.titulo}}</td>
                            <td>{{pro.precio}}</td>
                            <td>{{pro.estado}}</td>
                            <td>{{pro.descripcion}}</td>
                            <td><button @click="verFotos(pro.path2)">Ver</button></td>
                            <td>
                                <button type="submit"  v-if="!editrEliminar" class="btn" @click="deseaEliminar"  style="width: 100%; background-color: #FF9292">Eliminar</button>
                                <button type="submit"  v-if="editrEliminar" class="btn" @click="eliminarPublicacion(pro.id, 1)"  style="width: 100%; background-color: red">Confirmar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>


                <h1 style="text-align: center; font-size: 25px">Inmuebles</h1>
                <div style="margin-bottom: 5%; margin-top: 2%">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Sector</th>
                            <th scope="col">Lote</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Sup</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fotos</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(inm,key) in inmuebles" >
                            <td>{{key + 1}}</td>
                            <td>{{inm.name}}</td>
                            <td>{{inm.titulo}}</td>
                            <td>{{inm.nomSector}}</td>
                            <td>{{inm.lote}}</td>
                            <td>{{inm.estado}}</td>
                            <td>{{inm.precio}}</td>
                            <td>{{inm.superficie_total}}</td>
                            <td>{{inm.descripcion}}</td>
                            <td><button @click="verFotos(inm.path2)">Ver</button></td>
                            <td>
                                <button type="submit"  v-if="!editrEliminar" class="btn" @click="deseaEliminar"  style="width: 100%; background-color: #FF9292">Eliminar</button>
                                <button type="submit"  v-if="editrEliminar" class="btn" @click="eliminarPublicacion(inm.id, 3)"  style="width: 100%; background-color: red">Confirmar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <h1 style="text-align: center; font-size: 25px">Servicios</h1>
                <div style="margin-bottom: 5%; margin-top: 2%">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Comentarios</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Fotos</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(ser,key) in servicios" >
                            <td>{{key + 1}}</td>
                            <td>{{ser.name}}</td>
                            <td>{{ser.titulo}}</td>
                            <td>{{ser.nombre}}</td>
                            <td>{{ser.numero}}</td>
                            <td>{{ser.comentarios}}</td>
                            <td>{{ser.direccion}}</td>
                            <td><button @click="verFotos(ser.path2)">Ver</button></td>
                            <td>
                                <button type="submit"  v-if="!editrEliminar" class="btn" @click="deseaEliminar"  style="width: 100%; background-color: #FF9292">Eliminar</button>
                                <button type="submit"  v-if="editrEliminar" class="btn" @click="eliminarPublicacion(ser.id, 3)"  style="width: 100%; background-color: red">Confirmar</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div class="modal  fade"  id="modalFotos" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
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
import Button from "@/Jetstream/Button";

export default {
    name: "Publicaciones",
    props: ['productos','inmuebles','servicios'],
    components: {
        Button,
        AppLayout,
        Welcome,
    },
    data()
    {
        return{
            fotos: [],
            editrEliminar: false,
            form:{
                id:'',
                cate:'',
            }
        }
    },
    methods:
        {
            verFotos($path){
                this.fotos = $path;
                $('#modalFotos').modal();
            },
            deseaEliminar(){
                this.editrEliminar = true;
            },
            eliminarPublicacion($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;
                this.$inertia.post('/eliminarPublicacion', this.form);
                this.editrEliminar = false;
            },
        }

}
</script>
<style>
.botones{
    float: left; margin-left: 5%; width: 40%; margin-right: 5%;
    background-color: #00b3ee;
    text-align: center;
    font-size: 25px;
    margin-bottom: 5%;
    height: 100px;
    border-radius: 25px;
}
</style>
