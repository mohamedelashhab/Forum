<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="removed(index)"></reply>
        </div>

        <new-reply @added="add"></new-reply>

    </div>
</template>



<script>
import Reply from './Reply.vue';
import NewReply from './NewReply.vue';

export default {
    props : ['data'],
    components : {
        reply : Reply,
        newReply: NewReply,
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
            flash('reply deleted');
        },
        add(data){
            this.items.push(data);
            this.$emit('add');
            $(this.$el).fadeIn(300, function () {
                flash('Your reply has been added.'); 
            });
            
       
        }
    }
}

</script>