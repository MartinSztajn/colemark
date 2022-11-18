<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="margin-bottom: 5%">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sector:</h2>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="sec in sector" :key="sec.id">
                                <td>{{sec.titulo}}</td>
                                <td><button @click="borrarSector(sec.id)" class="btn btn-primary">Borrar</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="margin-bottom: 5%">
                    <h2 style="margin: 20px">Nombre Sector:</h2>
                    <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="titulo" >
                    <br>
                    <button class="btn btn-success" @click="guardarSector">Guardar Sector</button>
                    <h2 v-if="this.listo == 1" style="text-align: center; color: darkgreen"> Se Creo exitosamente el Sector </h2>

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
    name: "sector",
    props: ['sector'],
    components: {
        Button,
        AppLayout,
        Welcome,
    },
    data()
    {
        return{
            listo: 0,
            titulo: '',
            form:{
            }
        }
    },
    methods:
        {
            guardarSector()
            {
                if(this.listo == 0)
                {
                    this.listo = 1;
                    axios.post('/guardarSector/' + this.titulo);
                }
            },
            borrarSector($id)
            {

                this.$inertia.post('/borrarSector/' + $id);
            },
        }
}
</script>
