<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <label for="reply"></label>
                <textarea id="reply" class="form-control" name="body" placeholder="Have something to say" rows="5" v-model="body"></textarea>
            </div>
            <button @click.prevent="addReply" class="btn btn-primary">post</button>
        </div>   
            
        <div v-else class="col-md-8"> <p class="text-center"> please <a href="/login">login</a> to participate in this discussion </p> </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            body: '',
            endpoint: location.pathname + '/replies',
        }
    },
    methods: {
        addReply(){
            axios.post(this.endpoint, {body: this.body}).then((response)=>{
                this.body = '';
                this.$emit('added', response.data);
                flash('success , Reply added');
                
            });
        },
        signedIn(){
            return window.App.signedIn;
        },
    },
}
</script>