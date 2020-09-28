<template>
    <div>
        <div v-for="(reply, index) in replies" :key="index">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>
    </div>
</template>

<script>
import Reply from './Reply';

export default {
    props: ['data'],

    data(){
        return {
            replies: this.data
        }
    },

    methods: {
        remove(index) {
            this.replies.splice(index, 1);
            this.$emit('remove');
        }
    },

    components: { Reply }
}
</script>