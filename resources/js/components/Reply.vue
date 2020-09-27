<script>
import Favorite from './Favorite';

export default {
    props: ['attributes'],
    data() {
        return {
            body: this.attributes.body,
            editing: false
        }
    },
    methods: {
        update(){
            axios.patch('/replies/' + this.attributes.id, {
                body : this.body
            });

            this.editing = false;

            flash('Updated');
        },
        destroy(){
            
            axios.delete('/replies/' + this.attributes.id)
            .then((res) => {
                flash(res.data.status);
            });

            $(this.$el).fadeOut(300);

        }
    },
    components: {
        Favorite
    }
}
</script>