<template>

        <div class="col">
            <a @click="modallogin = !modallogin" class="btn btn-outline-light btn-lg ml-4 text-white">Ingresar</a>

            <div class="modal" style="background: #000000a1;display: block" v-show="modallogin">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modallogin = !modallogin">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- /.login-logo -->
                            <div class="login-box-body">
                                <p class="login-box-msg">
                                    Inicia sesión para comenzar a comprar</p>

                                <form method="post" >

                                    <input type="hidden" name="_token" :value="token">

                                    <div class="form-group has-feedback ">
                                        <input type="email" class="form-control" name="email" placeholder="Correo">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                    </div>

                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Contraseña" name="password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>


                                    </div>
                                    <div class="form-group">
                                        <!-- /.col -->
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Inicia</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>

                                <a >Olvidé mi contraseña</a><br>
                                <a class="text-center">Registra una nueva membresía</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


</template>

<script>
    export default {
        name: "ModalLogin",
        props:['action','token'],
        data(){
            return{
                modallogin:false
            }
        }
    }
</script>

<style scoped>

</style>