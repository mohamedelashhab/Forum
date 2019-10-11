<template>
    <div>
        <div v-for="(reply, index) in items">
            <reply :data="reply" @deleted="removed(index)"></reply>
        </div>

    </div>
</template>



<script>
import Reply from './Reply.vue';

export default {
    props : ['data'],
    components : {
        reply : Reply,
    },
    data() {
        return {
            items : this.data,
        }
    },
    methods:{
        removed(index){
            this.items.splice(index, 1);
            this.$emit('removed');
            flash('reply deleted')
        }
    }
}

</script>