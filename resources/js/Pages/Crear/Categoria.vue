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
                            <tr v-for="cate in categoria" :key="cate.id">
                                <td>{{cate.titulo}}</td>
                                <td><button @click="borrarCategoria(cate.id)" class="btn btn-primary">Borrar</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="margin-bottom: 5%">
                    <h2 style="margin: 20px">Nombre Categoria:</h2>
                    <input style="width: 95%; margin-right: 2%; margin-left: 2%" type="text"   class="form-control" v-model="titulo" >
                    <br>
                    <button class="btn btn-success" @click="guardarCategoria">Guardar Categoria</button>
                    <h2 style="text-align: center; color: darkgreen"> Se Creo exitosamente la Categoria </h2>

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
    name: "Categoria",
    props: ['categoria'],
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
            guardarCategoria()
            {
                this.listo = 1;
                    axios.post('/guardarCategoria/' + this.titulo);

            },
            borrarCategoria($id)
            {

                this.$inertia.post('/borrarCategoria/' + $id);
            },
        }
}
</script>
