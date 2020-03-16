<template>
<div>
    <a class="shadow-lg btn btn-success btn-lg btn-block" href="#" @click="show=!show">Carrito <span class="badge badge-secondary">{{ orden.length }}</span></a>

    <div class="jumbotron carro bg-white" v-show="show">

        <ul class="list-group list-group-flush " data-spy="scroll"  data-offset="0">
            <li class="media" v-for="(item,i) in orden" style="padding: 5px;border-bottom: solid 1px #c7c7c7">
                <img class="mr-3 w-25" :src="item.imagen" alt="Generic placeholder image">
                <div class="media-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="quitar(i)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="mt-0 mb-1" v-text="item.nombre"></h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <span v-text="number_format(item.subtotal)"></span>
                            </div>
                            <div class="col-sm">
                                <input type="number" min="1" class="form-control float-right" v-model.number="item.cantidad" >
                            </div>
                        </div>
                    </div>

                </div>
            </li>
        </ul>
        <label> Direccion de envio </label>
        <input type="email" class="form-control my-4"  placeholder="Direccion de envio" v-model="direccion">

        <hr class="my-4">
        <p class="float-right">Total: {{ number_format(total) }}</p>
        <a class="btn btn-primary btn-lg" href="#" role="button" @click="comprar">Comprar</a>
        <button type="button" class="btn btn-light btn-lg" @click="show = !show">Cerrar</button>
    </div>
</div>


</template>

<script>

    export default {
        name: "CarroCompra",
        props:['usuario_id'],
        data(){
            return{
                show:false,
                direccion:'',
                usuario :this.usuario_id,
                orden:[]
            }
        },
        computed:{
            total(){
                let $this = this;
                var total = 0
                this.orden.forEach( function(valor, indice, array) {
                    const subtotal = valor.precio * valor.cantidad;
                    $this.orden[indice].subtotal = subtotal;
                    total += subtotal
                })
                return total
            }
        },
        methods:{
            number_format(number){
              return new Intl.NumberFormat("es-CO").format(number)
            },
            quitar(index){
                this.orden.splice(index,1);
            },
            comprar(){
                let $this = this;
                if(this.orden.length!=0){
                    if(this.direccion === ''){
                        alert('la direccion de envio es obligatoria')
                        return
                    }
                    if(this.usuario_id){
                        let rest = {
                            cliente_id:this.usuario_id,
                            detalle:this.orden,
                            total:this.total,
                            direccion:this.direccion
                        }

                        axios.post('/api/saveorden', rest)
                            .then(function (response) {

                                const $res = response.data.data;
                                if($res === "ok"){
                                    $this.show = false;
                                    $this.orden = []
                                    $this.$localStorage.set('orden', JSON.stringify([]));
                                    alert('Orden enviada con Exito')
                                }else{
                                    alert('Ocurrio un error')
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }else{
                        this.show = false;
                        this.$emit('login');
                    }



                }else{
                    alert('Selecciona un producto')
                }

            }

        },
        created(){

            let $this = this;
            $this.orden = (!this.$localStorage.get('orden'))?[]:JSON.parse(this.$localStorage.get('orden'));

            EventBus.$on('producto',(producto)=>{
                producto.cantidad = 1;
                $this.orden.push(producto)
                this.$localStorage.set('orden', JSON.stringify($this.orden));
            })

        }
    }
</script>

<style>

    @media screen and (max-width:640px) {
        .carro{
            left: 0px;
            top: 0px;
            bottom: 0px;
            position: fixed !important;
            width: 100% !important;
            height: 100% !important;
        }
    }
    .carro{
        position: absolute;
        z-index: 99;
        padding: 10px !important;
        width: 30vw;
        height: 50vh;
        right: 0px;
        border: 2px solid #971208;
        overflow-y: auto;
    }

</style>