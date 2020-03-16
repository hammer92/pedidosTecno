<template>
    <div>
        <!-- Producto Id Field -->
        <div class="form-group col-sm-4">
            <label >Producto:</label>
            <input type="hidden"  name="producto_id" v-model="form.producto_id"/>
            <v-select @input="setActiveProduc" label="nombre" :options="options" @search="onSearch" taggable push-tags >
                <template slot="no-options">
                    Buscar Producto
                </template>
            </v-select>
        </div>
        <!-- Precio Field -->
        <div class="form-group col-sm-2">
            <label >Precio:</label>
            <input name="precio" type="text"  class="form-control" v-model="form.precio" readonly>
        </div>
        <!-- Cantidad Field -->
        <div class="form-group col-sm-2 ">
            <label >Cantidad:</label>
            <input name="cantidad" type="text"  class="form-control" v-model="form.cantidad">
        </div>
        <!-- Subtotal Field -->
        <div class="form-group col-sm-2">
            <label >Subtotal:</label>
            <input name="subtotal" type="text"  class="form-control" v-model="subtotal" readonly>
        </div>

    </div>

</template>

<script>
    export default {
        name: "AutoCliente",
        data() {
            return {
                options: [],
                form:{
                    producto_id:'',
                    precio:'',
                    cantidad:'',
                }
            }

        },
        computed:{
            subtotal(){
                return this.form.precio * this.form.cantidad
            }
        },
        methods: {
            setActiveProduc(val) {
                this.form.producto_id = val.id;
                this.form.precio = val.precio;
            },
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                fetch(
                    `/api/productos?searchFields=nombre:like&filter=id;nombre;precio&search=${escape(search)}`
                ).then(res => {
                    res.json().then(json => (vm.options = json.data));
                    loading(false);
                });
            }, 350)
        }
    }
</script>

<style scoped>

</style>