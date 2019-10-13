<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="removed(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <new-reply @added="add"></new-reply>

    </div>
</template>



<script>
import Reply from './Reply.vue';
import NewReply from './NewReply.vue';
import collection from '../mixins/collection.js';

export default {

    mixins: [collection],

    components : {
        reply : Reply,
        newReply: NewReply,
    },
    data() {
        return {
            dataSet: [],
        }
    },
    created() {
        this.fetch();
    },
    methods:{
        fetch(page){
            if(!page){
                let query = location.search.match(/page=(\d+)/);    
                page = query? query[1] : 1;
            }
            axios.get(this.url(page))
            .then((response) => {

               response.data.data.length >= 1 ? this.refresh(response) : this.reload();

            });
        },
        url(page){
           return ` ${location.pathname}/replies?page=${page} `;
        },
        refresh(response){
            this.dataSet = response.data;
            this.items = response.data.data;
        },

        reload(){
            history.pushState(null, null, '?page=' + 1);
            location.reload();
        }
        
    }
}

</script>