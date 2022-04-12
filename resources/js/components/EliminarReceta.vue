<template>
  <input
  type="submit"
  class="btn btn-danger mr-1 d-block w-100 mb-1"
  value="Eliminar"
  @click="eliminarReceta"
  />
</template>

<script>import Axios from "axios"

export default {
    props:{
        recetaId: {
            require: true,
            type: String
        }
    },
    mounted(){
        // console.log(this.recetaId);
    },
    methods:{
        eliminarReceta(){
            this.$swal({
                title: '¿Quieres borrar esta receta?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result) => {
                const params = {
                    id: this.recetaId
                }
                //Enviar petición al servidor
                axios.post('/recetas/' + this.recetaId, {
                    params, _method: 'delete'
                }).then(resp => {
                    if (result.isConfirmed) {
                        this.$swal.fire({
                            title: '¡Eliminado!',
                            text: 'Se eliminó la receta!',
                            icon: 'success'
                        })

                        //Eliminar receta del DOM
                        this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                    }
                }).catch(e => console.log(e))

            })
        }
    }
}
</script>

<style>

</style>
