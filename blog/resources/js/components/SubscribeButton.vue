<template>
    <div>
        <button :class = "classes" @click="subscribe" v-text="text"></button>
    </div>
</template>

<script>
export default {
    props : ['flag'],

    data() {
        return {
            active : this.flag,
            text : this.active ?  'unsubscribe' : 'subscribe',
        }
    },
    computed: {
        classes(){
            return ['btn', this.active? 'btn-danger': 'btn-primary'];
        }
    },

    methods: {
        subscribe(){
            axios[this.active ? 'delete' : 'post']
            (location.pathname + '/subscribtions')
            .then(()=>{
                this.text = this.active ? "unsubscribed" : "subscribed"
                flash(this.text);
                this.active = !this.active;
                 
            });
        }
    },


}
</script>

<style lang="">
    
</style>