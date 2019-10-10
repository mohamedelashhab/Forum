

<script>
    export default {
        props: ['reply'],
        data() {

            return {
                editing: false,
                body: this.reply.body,
            }
            
        },

        methods: {
            update() {
                
                // alert(this.body);
                axios.patch('/replies/' + this.reply.id, {
                    body:this.body,
                });
                this.editing = false;
                flash('Updated!');
            },
            destroy(){
                axios.delete('/replies/' + this.reply.id);
                $(this.$el).fadeOut(300, function () {
                flash('Your reply has been deleted.');
            });
            }
        }
    }
</script>



