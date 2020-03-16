<template>
    <div class="container top">
        <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-6" v-for=" item in productos">
            <div class="card text-center border-0" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <img class="card-img-top" :src="item.imagen" alt="Card image cap">
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card-body">
                                <h5 class="name" v-text="item.nombre"></h5>
                                <p class="decreption" v-text="item.descripcion"></p>
                                <p class="price text-danger" v-text="'$ '+item.precio"></p>
                                <a href="#" class="btn btn-primary btn-lg bg-danger border-0" @click="comprar(item)">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductoTabs",
        props:['categoria_id'],
        data(){
            return{
                items:[]
            }
        },
        computed:{
          productos(){
              let $this= this;
              return this.items.filter(data => data.categoria_id === $this.categoria_id );
          }
        },
        mounted(){
            axios
                .get('/api/productos?filter=id;nombre;descripcion;precio;imagen;categoria_id')
                .then(response => (this.items = response.data.data))
        },
        methods:{
            comprar(producto){
                EventBus.$emit('producto', producto)
            }
        }



    }
</script>

<style scoped>

    @media screen and (max-width:640px) {
        .top{
            margin-top: 365px !important;
        }
    }

    .top{
        margin-top: 250px;
    }

</style>