<template>
    <app-layout>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                    <div style="margin-bottom: 5%">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-aling: center; margin-bottom: 30px">Seleccionar Categoria:</h2>
                        <select style="width: 95%; margin-right: 2%; margin-left: 2%; margin-bottom: 30px"
                                class="form-control" v-model="categoria" >
                            <option v-for="cate in categorias"  :key="cate.id" :value="cate.titulo">{{cate.titulo}}</option>
                        </select>

                        <button class="btn" style="width: 50%; margin-left: 25%; background-color: #A9CCFF; border-color: white" @click="Avanzar">Avanzar</button>
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
    name: "Crear",
    props: ['categorias'],
    components: {
        Button,
        AppLayout,
        Welcome,
    },
    data()
    {
        return{
            categoria: ''
        }
    },
    methods:
        {
            Avanzar()
            {
                if (this.categoria != ''){
                     this.$inertia.get('/cargarCategoria/' + this.categoria);
                }
            },
        }
}

/*

      let me = this;
                this.validarDatos();

                if(me.errorMostrarMsjVenta != '')
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Debe Completar',
                        html: me.errorMostrarMsjVenta,
                        footer: 'Vuelva a intentar'
                    })
                }
                else
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Muchas Gracias!',
                        html: me.errorMostrarMsjVenta,
                        footer: 'En breve la podes ver aqui abajo'
                    });
                    this.$inertia.post('/crearPrenda',this.form).then(()=>{});

                }
 */
</script>
