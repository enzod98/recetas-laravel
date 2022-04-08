<template>
  <span>{{ formatearFecha }}</span>
</template>

<script>
export default {
    props:{
        fecha: String
    },
    computed: {
        formatearFecha(){
            return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
        }
    }
}
</script>

<style>

</style>
