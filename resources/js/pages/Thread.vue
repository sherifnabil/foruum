<script>
import Replies from '../components/Replies';

export default {
    props: ['initiailRepliesCount'],

    components: { Replies },

    data(){
        return{
            repliesCount: this.initiailRepliesCount
        }
    }
}
</script>