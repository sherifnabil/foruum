<template>
    <div>
        <div>
            <div class="card" :id="'reply-'+id">
                <div class="card-header">
                    <div class="level">
                        <a
                        :href="'/profiles/' + data.owner.name"
                        v-text="data.owner.name"
                        >
                        </a> Said ... {{ data.created_at }}
                        <div class="pull-right" v-if="signedIn">
                            <favorite :reply="data"></favorite>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div v-if="editing">
                        <div class="form-group">
                            <textarea class="form-control" v-model="body" ></textarea>
                        </div>
                        <button @click="update" class="btn btn-success ml-2">Update</button>
                        <button @click="editing = false" class="btn btn-link ml-2">Cancel</button>

                    </div>
                    <div v-else v-text="body"></div>
                </div>
            
                <div class="card-footer" v-if="canUpdate">
                    <button @click="editing = true" class="btn btn-info btn-xs pull-right ml-2">Edit</button>
                    <button @click="destroy" class="btn btn-danger pull-right btn-xs">Delete</button>
                </div>
                
            </div><br>
        </div>
    </div>
</template>

<script>
import Favorite from './Favorite';

export default {
    props: ['data'],
    data() {
        return {
            body: this.data.body,
            editing: false,
            id: this.data.id
        }
    },
    methods: {
        update(){
            axios.patch('/replies/' + this.data.id, {
                body : this.body
            });

            this.editing = false;

            flash('Updated');
        },
        destroy(){
            
            axios.delete('/replies/' + this.data.id)
            .then((res) => {
                flash(res.data.status);
            });

            this.$emit('deleted', this.data.id)
            // $(this.$el).fadeOut(300);

        }
    },

    computed: {
        signedIn(){
            return window.App.signedIn;
        },
        canUpdate(){
            return this.authorize(user => this.data.user_id == user.id);
        }
    },
    
    components: {
        Favorite
    }
}
</script>