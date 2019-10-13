
<script>
import Replies from '../components/Replies';
import SubscribeButton from '../components/SubscribeButton.vue';
export default {

    props: ['initialRepliesCount'],
    data() {
        return {
            repliesCount : this.initialRepliesCount,
        }
    },

    components : {
        replies : Replies,
        SubscribeButton,
    }
}
</script>