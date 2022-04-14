<template>
    <div>
        <span class="like-btn"
            @click="likeReceta"
            :class="{ 'like-active' : isActive }">
        </span>
        <p>A {{ totalLikes }} les gustó la receta</p>
    </div>
</template>

<script>
export default {
    props: ['recetaId', 'like', 'likes'],
    data: function(){
        return{
            isActive: this.like,
            totalLikes: this.likes
        }
    },
    methods:{
        likeReceta(){
            axios.post('/recetas/' + this.recetaId)
                .then(resp => {
                    resp.data.attached.length > 0
                        ? this.$data.totalLikes++
                        : this.$data.totalLikes--

                    this.$data.isActive = ! this.$data.isActive
                })
                .catch(err => {
                    if(err.response.status === 401){
                        window.location = '/register'
                    }
                })
        }
    },
    mounted(){
        $('.like-btn').on('click', function() {
            $(this).toggleClass('like-active');
        });
    },
    computed: {
        cantidadLikes(){
            return this.likes;
        }
    }
}
</script>
