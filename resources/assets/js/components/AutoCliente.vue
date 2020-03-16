<template>
    <div>
        <div class="form-group col-sm-3" v-show="false">
            <input name="cliente_id" type="text" class="form-control" v-model="form.id">
        </div>

        <div class="form-group col-sm-3">
            <label >Telefono:</label>
            <input type="hidden"  name="telefono" v-model="form.telefono"/>
            <v-select @input="setActivePerson" label="telefono" :options="options" @search="onSearch" taggable push-tags v-model="telefono">
                <template slot="no-options">
                    Buscar Cliente
                </template>
            </v-select>
        </div>

        <!-- Nombre Field -->
        <div class="form-group col-sm-3">
            <label >Nombre:</label>
            <input name="name" type="text"  class="form-control" v-model="form.name">
        </div>

        <div class="form-group col-sm-3">
            <label >Corrreo:</label>
            <input name="email" type="text" class="form-control" v-model="form.email">
        </div>

        <!-- Direccion Field -->
        <div class="form-group col-sm-3">
            <label >Direccion:</label>
            <input name="direccion" type="text"  class="form-control" v-model="form.direccion">
        </div>
        <!-- Direccion Field -->
        <div class="form-group col-sm-3">
            <label >Direccion:</label>
            <input name="direccion" type="text"  class="form-control" v-model="form.direccion">
        </div>
    </div>

</template>

<script>
    export default {
        name: "AutoCliente",
        props:['name','email','id','telefono','direccion'],
        data() {
            return {
                options: [],
                form:{
                    id:this.id,
                    name:this.name,
                    email:this.email,
                    telefono:this.telefono,
                    direccion:this.direccion
                }
            }

        },
        methods: {
            setActivePerson(val) {
                console.log(val)
                this.form.telefono = (val.telefono != undefined)?val.telefono:val;
                this.form.id = (val.id != undefined)?val.id:this.id;
                this.form.name = (val.name != undefined)?val.name:this.name;
                this.form.email = (val.email != undefined)?val.email:this.email;
                this.form.direccion = (val.direccion != undefined)?val.direccion:this.direccion;
            },
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                fetch(
                    `/api/users?searchFields=telefono:like&filter=id;name;telefono;email&search=${escape(search)}`
                ).then(res => {
                    res.json().then(json => (vm.options = json.data));
                    loading(false);
                });
            }, 350)
        }
    }
</script>

<style>
    .selected-tag {
        position: absolute !important;
    }
</style>