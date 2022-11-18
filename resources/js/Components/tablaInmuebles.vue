<template>
    <tr>
        <td>
            <p v-if="editrtitulo == false " @dblclick="editarTitulo()">  {{pub.titulo}}</p>
            <input ref="cellinput" type="text" v-show="editrtitulo == true"
                   v-model="pub.titulo"
                   @keyup.enter="guardarTitulo">
        </td>
        <td>
            <p v-if="editrprecio == false " @dblclick="editarPrecio()">  {{pub.precio}}</p>
            <input ref="cellinput" type="text" v-show="editrprecio == true"
                   v-model="pub.precio"
                   @keyup.enter="guardarPrecio">
        </td>
        <td>
            <p v-if="editrestado == false && pub.estado == 1" @dblclick="editarEstado()">Venta</p>
            <p v-if="editrestado == false && pub.estado == 0" @dblclick="editarEstado()">Alquiler</p>

            <button ref="cellinput" type="button" v-show="editrestado == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: green"
                    @click="guardarEstado(1)"> Venta
            </button>
            <button ref="cellinput" type="button" v-show="editrestado == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: red"
                    @click="guardarEstado(0)"> Alquiler
            </button>
        </td>
        <td>
            <p v-if="editrlote == false " @dblclick="editarLote()">  {{pub.lote}}</p>
            <input ref="cellinput" type="text" v-show="editrlote == true"
                   v-model="pub.lote"
                   @keyup.enter="guardarLote">
        </td>
        <td>
            <p v-if="editrdormitorios == false " @dblclick="editarDormitorios()">  {{pub.dormitorios}}</p>
            <input ref="cellinput" type="text" v-show="editrdormitorios == true"
                   v-model="pub.dormitorios"
                   @keyup.enter="guardarDormitorios">
        </td>
        <td>
            <p v-if="editrsuperficie == false " @dblclick="editarSuperficie()">  {{pub.superficie_total}}</p>
            <input ref="cellinput" type="text" v-show="editrsuperficie == true"
                   v-model="pub.superficie_total"
                   @keyup.enter="guardarSuperficie">
        </td>
        <td>
            <p v-if="editrpisos == false " @dblclick="editarPisos()">  {{pub.pisos}}</p>
            <input ref="cellinput" type="text" v-show="editrpisos == true"
                   v-model="pub.pisos"
                   @keyup.enter="guardarPisos">
        </td>
        <td>
            <p v-if="editrbaños == false " @dblclick="editarBaños()">  {{pub.baños}}</p>
            <input ref="cellinput" type="text" v-show="editrbaños == true"
                   v-model="pub.baños"
                   @keyup.enter="guardarBanos">
        </td>
        <td>
            <p v-if="editrambientes == false " @dblclick="editarAmbientes()">  {{pub.ambientes}}</p>
            <input ref="cellinput" type="text" v-show="editrambientes == true"
                   v-model="pub.ambientes"
                   @keyup.enter="guardarAmbientes">
        </td>
        <td>
            <p v-if="editrjardin == false && pub.jardin == 1" @dblclick="editarJardin()">Si</p>
            <p v-if="editrjardin == false && pub.jardin == 0" @dblclick="editarJardin()">No</p>

            <button ref="cellinput" type="button" v-show="editrjardin == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: green"
                    @click="guardarJardin(1)"> Si
            </button>
            <button ref="cellinput" type="button" v-show="editrjardin == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: red"
                    @click="guardarJardin(0)"> No
            </button>
        </td>
        <td>
            <p v-if="editrpileta == false && pub.pileta == 1" @dblclick="editarPileta()">Si</p>
            <p v-if="editrpileta == false && pub.pileta == 0" @dblclick="editarPileta()">No</p>

            <button ref="cellinput" type="button" v-show="editrpileta == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: green"
                    @click="guardarPileta(1)"> Si
            </button>
            <button ref="cellinput" type="button" v-show="editrpileta == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: red"
                    @click="guardarPileta(0)"> No
            </button>
        </td>
        <td>
            <p v-if="editrparilla == false && pub.parilla == 1" @dblclick="editarParilla()">Si</p>
            <p v-if="editrparilla == false && pub.parilla == 0" @dblclick="editarParilla()">No</p>

            <button ref="cellinput" type="button" v-show="editrparilla == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: green"
                    @click="guardarParilla(1)"> Si
            </button>
            <button ref="cellinput" type="button" v-show="editrparilla == true"
                    style="float:left; margin-right: 5px; width: 70px; text-align: center; background-color: red"
                    @click="guardarParilla(0)"> No
            </button>
        </td>
        <td>
            <button type="submit"  v-if="!editrEliminar" class="btn" @click="deseaEliminar"  style="width: 100%; background-color: #FF9292">Eliminar</button>
            <button type="submit"  v-if="editrEliminar" class="btn" @click="eliminarPublicacion(pub.id, 2)"  style="width: 100%; background-color: red">Confirmar</button>
        </td>

    </tr>


</template>

<script>
export default {
    name: "tablaInmuebles",
    props: ['pub','id'],
    data()
    {
        return{
            editrtitulo: false,
            editrprecio: false,
            editrestado: false,
            editrlote: false,
            editrdormitorios: false,
            editrsuperficie: false,
            editrpisos: false,
            editrbaños: false,
            editrambientes: false,
            editrjardin: false,
            editrpileta: false,
            editrparilla: false,
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
            editarEstado()
            {
                this.editrestado = true;
            },
            editarLote()
            {
                this.editrlote = true;
            },
            editarDormitorios()
            {
                this.editrdormitorios = true;
            },
            editarSuperficie()
            {
                this.editrsuperficie = true;
            },
            editarPisos()
            {
                this.editrpisos = true;
            },
            editarBaños()
            {
                this.editrbaños = true;
            },
            editarAmbientes()
            {
                this.editrambientes = true;
            },
            editarJardin()
            {
                this.editrjardin = true;
            },
            editarPileta()
            {
                this.editrpileta = true;
            },
            editarParilla()
            {
                this.editrparilla = true;
            },


            guardarTitulo()
            {
                this.editrtitulo = false;
                axios.post('/editarInmueble', {tipo: 'Titulo', valor: this.pub.titulo,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarPrecio()
            {
                this.editrprecio = false;
                axios.post('/editarInmueble', {tipo: 'Precio', valor: this.pub.precio,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarEstado($num)
            {
                this.editrestado = false;
                axios.post('/editarInmueble', {tipo: 'Estado', valor: $num,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarLote()
            {
                this.editrlote = false;
                axios.post('/editarInmueble', {tipo: 'Lote', valor: this.pub.lote,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarDormitorios()
            {
                this.editrdormitorios = false;
                axios.post('/editarInmueble', {tipo: 'Dormitorios', valor: this.pub.dormitorios,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarSuperficie()
            {
                this.editrsuperficie = false;
                axios.post('/editarInmueble', {tipo: 'Superficie', valor: this.pub.superficie_total,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarPisos()
            {
                this.editrpisos = false;
                axios.post('/editarInmueble', {tipo: 'Pisos', valor: this.pub.pisos,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarBanos()
            {
                this.editrbaños = false;
                axios.post('/editarInmueble', {tipo: 'Baños', valor: this.pub.baños,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarAmbientes()
            {
                this.editrambientes = false;
                axios.post('/editarInmueble', {tipo: 'Ambientes', valor: this.pub.ambientes,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarJardin($num)
            {
                this.editrjardin = false;
                axios.post('/editarInmueble', {tipo: 'Jardin', valor: $num,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarPileta($num)
            {
                this.editrpileta = false;
                axios.post('/editarInmueble', {tipo: 'Pileta', valor: $num,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
            },
            guardarParilla($num)
            {
                this.editrparilla = false;
                axios.post('/editarInmueble', {tipo: 'Parilla', valor: $num,
                    id: this.pub.id}).then();
                alert('Has modificado '+ this.pub.titulo)
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
