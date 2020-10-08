<template>
    <div>
        <div v-for="(reply, index) in replies" :key="index">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>
        
        <new-reply :endpoint="endpoint" @created="add"></new-reply>
    </div>
</template>

<script>
import Reply from './Reply';
import NewReply from './NewReply';

export default {
    props: ['data'],

    data(){
        return {
            replies: this.data,
            endpoint: location.pathname + '/replies'
        }
    },

    methods: {
        remove(index) {
            this.replies.splice(index, 1);
            this.$emit('remove');
        },
        add(reply){
            this.replies.push(reply);
            
            this.$emit('added')
        }
    },

    components: { Reply , NewReply}
}
</script>