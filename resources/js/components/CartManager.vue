<template>
    <div style="display:inline-block;">
       <button v-bind:class="[color]" @click='addToCart'>{{btnName}}</button>
    </div>
</template>

<script>
    export default {
        props: ['itemId'],

        data(){
            return {
                btnName: 'Cart',
                color: 'btn btn-primary',
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            addToCart() {
                axios.get("/cart/add/" + this.itemId)
                    .then(this.btnName = 'Added', this.color = 'btn btn-secondary disabled');
            }
        }
    }
</script>
