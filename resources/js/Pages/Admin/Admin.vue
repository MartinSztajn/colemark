<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                    <button class="botones" onclick="location.href='/verUsuarios'">Ver Usuarios</button>
                    <button class="botones" onclick="location.href='/verPublicaciones'">Ver Publicaciones</button>
                    <button class="botones" onclick="location.href='/crearSector'">Crear Sector</button>
                    <button class="botones" onclick="location.href='/crearCategoria'">Crear Categoria</button>
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
    props: [''],
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
