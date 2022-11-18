<template>
    <tr>
        <td>
            <p v-if="editrtitulo == false " @dblclick="editarTitulo()">  {{pub.titulo}}</p>
            <input ref="cellinput" type="text" v-show="editrtitulo == true"
                   v-model="pub.titulo"
                   @keyup.enter="guardarTitulo">
        </td>
        <td>
            <p v-if="editrnombre == false " @dblclick="editarNombre()">  {{pub.nombre}}</p>
            <input ref="cellinput" type="text" v-show="editrnombre == true"
                   v-model="pub.nombre"
                   @keyup.enter="guardarNombre">
        </td>
        <td>
            <p v-if="editrcelular == false " @dblclick="editarCelular()">  {{pub.numero}}</p>
            <input ref="cellinput" type="text" v-show="editrcelular == true"
                   v-model="pub.numero"
                   @keyup.enter="guardarCelular">
        </td>
        <td>
            <p v-if="editrdireccion == false " @dblclick="editarDireccion()">  {{pub.direccion}}</p>
            <input ref="cellinput" type="text" v-show="editrdireccion == true"
                   v-model="pub.direccion"
                   @keyup.enter="guardarDireccion">
        </td>
        <td>
            <p v-if="editrcomentarios == false " @dblclick="editarComentarios()">  {{pub.comentarios}}</p>
            <input ref="cellinput" type="text" v-show="editrcomentarios == true"
                   v-model="pub.comentarios"
                   @keyup.enter="guardarComentarios">
        </td>
        <td>
            <button type="submit" class="btn" @click="deseaEliminar(pub.id, 3)"  style="width: 100%; background-color: red">Eliminar</button>
        </td>

    </tr>


</template>

<script>
export default {
    name: "tablaServicios",
    props: ['pub','id'],
    data()
    {
        return{
            editrtitulo: false,
            editrnombre: false,
            editrcomentarios: false,
            editrcelular: false,
            editrdireccion: false
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
            editarNombre()
            {
                this.editrnombre = true;
            },
            editarComentarios()
            {
                this.editrcomentarios = true;
            },
            editarCelular()
            {
                this.editrcelular = true;
            },
            editarDireccion()
            {
                this.editrdireccion = true;
            },
            guardarTitulo()
            {
                this.editrtitulo = false;
                axios.post('/editarServicio', {tipo: 'Titulo', valor: this.pub.titulo,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarComentarios()
            {
                this.editrcomentarios = false;
                axios.post('/editarSerivicio', {tipo: 'Comentarios', valor: this.pub.comentarios,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarNombre()
            {
                this.editrnombre = false;
                axios.post('/editarSerivicio', {tipo: 'Nombre', valor: this.pub.nombre,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarCelular()
            {
                this.editrcelular = false;
                axios.post('/editarSerivicio', {tipo: 'Numero', valor: this.pub.numero,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarDireccion()
            {p
                this.editrdireccion = false;
                axios.post('/editarSerivicio', {tipo: 'Direccion', valor: this.pub.direccion,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },



            deseaEliminar($id, $cate){
                this.form.id = $id;
                this.form.cate = $cate;
                $('#ModalquickView').modal();
            },
            eliminarPublicacion(){
                this.$inertia.post('/eliminarPublicacion', this.form);
            },
        },

}
</script>

<style scoped>

</style>
