<template>
 
        <div class="card" :id="'reply-'+ id">

                <div  class="card-header">
                    <div class="level">
                        <div class="flex">
                            <a :href="'profile'+ data.owner.name" v-text="data.owner.name"></a>said {{ data.created_at}}
                        </div>
                        <div>
                      
                            <favorite :reply="data" v-if="signedIn"></favorite>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div v-if="editing">
                        <textarea class="form-control" v-model="body"></textarea>
                    </div>

                    <div v-else>
                        <div v-text="body"></div>
                    </div>
                </div>

                
                <div class="card-footer level" v-if="canUpdate">
                    <button class="btn btn-primary btn-xs" v-if="!editing" @click = "editing = true">edit</button>&nbsp;&nbsp;
                    <button class="btn btn-xs btn-primary btn-xs" v-if="editing" @click = "update(data.id)">Update</button>&nbsp;&nbsp;
                    <button class="btn btn-danger btn-xs" v-if="!editing" @click = "destroy(data.id)">delete</button>
                    <button class="btn btn-primary btn-xs" v-if="editing" @click = "editing = false">cancel</button>

                </div>      
                
        </div>

</template>

<script>
    import Favorite from './Favorite';
    export default {
        props: ['data'],
        data() {

            return {
                editing: false,
                body: this.data.body,
                id: this.data.id,
            }
            
        },

        components : {
            favorite: Favorite,

        },

        computed: {
            signedIn(){
                return window.App.signedIn;
            },
            canUpdate(){
                return this.authorize(user => user.id == this.data.user_id);
            }
        },

        methods: {
            update() {
                
               
                axios.patch('/replies/' + this.data.id, {
                    body:this.body,
                });
                this.editing = false;
                flash('Updated!');
            },
            destroy(){
                axios.delete('/replies/' + this.data.id);
                this.$emit('deleted', this.data.id);
                $(this.$el).fadeOut(300, function () {
                flash('Your reply has been deleted.');
            });
            }
        }
    }
</script>



