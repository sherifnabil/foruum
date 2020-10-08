<template>
    <div>

        <div v-if="signedIn">

            <div class="form-group">
                <textarea
                    v-model="body"
                    placeholder="Have something to say"
                    class="form-control"
                    required
                    rows="5"
                ></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" @click="addReply" >Reply</button>
            </div>
        </div>

        <p v-else class="h3 text-center">Please <a href="/login"> Sign in </a> to participate in the Discussion </p>

    </div>
</template>
<script>
export default {
    props: ['endpoint'],
    data() {
        return {
            body: '',
        }
    },
    methods:{
        addReply(){
            axios.post(this.endpoint, { body: this.body })
            .then(({data}) => {
                this.body = '';

                flash('Your reply has been posted');
                // console.log(data);
                this.$emit('created', data)
                
            });
        }
    },
    computed: {
        signedIn(){
            return window.App.signedIn;
        }
    }
    
}
</script>