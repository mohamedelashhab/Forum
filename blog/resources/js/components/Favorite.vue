<template>
    <div>

        <button type="submit" :class="classes" @click="toggle()">
            <span class="glyphicon glyphicon-heart"></span>
            <span class="badge badge-primary" v-text="count"></span>
        </button>
    </div>

</template>

<script>
export default {
    props: ['reply'],
    data(){
        return {
            active : this.reply.isFavorited,
            count: this.reply.favoritesCount,
        }
    },
    computed: {
        classes(){
            return ["btn", this.active? "btn-danger" : "btn-default"];
        },
        endpoint() {
            return '/replies/' + this.reply.id + '/favorites';
        }
    },

    methods: {
        toggle(){
            this.active ? this.destroy() : this.create();
        },

        create(){
            axios.post(this.endpoint);
            this.active = true;
            this.count++;
        },

        destroy(){
            axios.delete(this.endpoint);
            this.active = false;
            this.count--;
        }
    },
}
</script>

