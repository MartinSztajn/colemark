<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >

                <h1 style="text-align: center; font-size: 25px">Total Usuarios: {{cant}}</h1>
                <div style="margin-bottom: 5%; margin-top: 2%">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Creado</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="us in Usuarios" :key="us.id">
                                <td>{{key + 1}}</td>
                                <td>{{us.name}}</td>
                                <td>{{us.email}}</td>
                                <td>{{us.celular}}</td>
                                <td>{{us.created_at}}</td>
                                <td>
                                    <button type="submit"  v-if="!editrEliminar" class="btn" @click="deseaEliminar"  style="width: 100%; background-color: #FF9292">Eliminar</button>
                                    <button type="submit"  v-if="editrEliminar" class="btn" @click="eliminarUsuario(us.id)"  style="width: 100%; background-color: red">Confirmar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

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
    name: "Admin",
    props: ['Usuarios','cant'],
    components: {
        Button,
        AppLayout,
        Welcome,
    },
    data()
    {
        return{
            listo: 0,
            editrEliminar: false,
            form:{
            }
        }
    },
    methods:
        {

            deseaEliminar(){
                this.editrEliminar = true;
            },
            eliminarUsuario($id){
                this.$inertia.post('/eliminarUsuario/' + $id);
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
