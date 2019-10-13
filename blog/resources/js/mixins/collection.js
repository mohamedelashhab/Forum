export default {
    data() {
        return {
            items: [],
        }
    },
    methods: {
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
    },
}