<template>
    <tr>
        <td>
            <p v-if="editrtitulo == false " @dblclick="editarTitulo()">  {{pub.titulo}}</p>
            <input ref="cellinput" type="text" v-show="editrtitulo == true"
                   v-model="pub.titulo"
                   @keyup.enter="guardarTitulo">
        </td>
        <td>

            <p v-if="editrprecio == false " @dblclick="editarPrecio()">  ${{pub.precio}}</p>
            <input ref="cellinput" type="number" v-show="editrprecio == true"
                   v-model="pub.precio"
                   @keyup.enter="guardarPrecio">
        </td>
        <td>
            <p v-if="editrestado == false && pub.estado == 1" @dblclick="editarEstado()">Nuevo</p>
            <p v-if="editrestado == false && pub.estado == 0" @dblclick="editarEstado()">Usado</p>

            <button ref="cellinput" type="text" v-show="editrestado == true"
                   style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: green"
                   @click="guardarEstado(1)"> Nuevo
            </button>
            <button ref="cellinput" type="text" v-show="editrestado == true"
                 style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: red"
                    @click="guardarEstado(0)"> Usado
            </button>
        </td>
        <td>
            <p v-if="editrdescripcion == false " @dblclick="editarDescripcion()">  {{pub.descripcion}}</p>
            <input ref="cellinput" type="text" v-show="editrdescripcion == true"
                   v-model="pub.descripcion"
                   @keyup.enter="guardarDescripcion">
        </td>
        <td>
            <button type="submit"  v-if="!editrEliminar" class="btn" @click="deseaEliminar"  style="width: 100%; background-color: #FF9292">Eliminar</button>
            <button type="submit"  v-if="editrEliminar" class="btn" @click="eliminarPublicacion(pub.id, 1)"  style="width: 100%; background-color: red">Confirmar</button>
        </td>

    </tr>
</template>


<script>
import Button from "@/Jetstream/Button";
export default {
    name: "tablaPublicaciones",
    components: {Button},
    props: ['pub','id','categorias'],
    data()
    {
        return{
            editrtitulo: false,
            editrprecio: false,
            editrdescripcion: false,
            editrcategoria: false,
            editrestado: false,
            editrEliminar: false,
            form:{
                id: '',
                cate: ''
            }
        }
    },
    watch: {
        producto: {
            handler: function(newValue) {
                console.log("Person with ID:" + newValue.id + " modified")
                console.log("New age: " + newValue.age)
            },
            deep: true
        }
    },
    methods:
        {
            editarTitulo()
            {
                this.editrtitulo = true;
            },
            editarPrecio()
            {
                this.editrprecio = true;
            },
            editarDescripcion()
            {
                this.editrdescripcion = true;
            },
            editarCategoria()
            {
                this.editrcategoria = true;
            },
            editarEstado()
            {
                this.editrestado = true;
            },
            guardarTitulo()
            {
                this.editrtitulo = false;
                axios.post('/editarPublicacion', {tipo: 'Titulo', valor: this.pub.titulo,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarDescripcion()
            {
                this.editrdescripcion = false;
                axios.post('/editarPublicacion', {tipo: 'Descripcion', valor: this.pub.descripcion,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarPrecio()
            {
                this.editrPrecio = false;
                axios.post('/editarPublicacion', {tipo: 'Precio', valor: this.pub.precio,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarEstado($num)
            {
                    this.editrEstado = false;
                    axios.post('/editarPublicacion', {tipo: 'Estado', valor: $num,
                        id: this.pub.id}).then();
                    alert('Has modificado '+ this.pub.titulo)
            },
            guardarCategoria()
            {
                this.editrlink = false;
                axios.post('/editarPublicacion', {tipo: 'Categoria', valor: this.pub.id_categoria,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.cla.titulo)
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
        },

}
</script>

<style scoped>

</style>
