<template>
    <span>
        <button
            @click="showVoteCountdown()"
            class="bg-purple-500 hover:bg-purple-700 text-xs text-gray-100 py-2 px-4 rounded"
        >
            Show Vote Countdown on Stream
        </button>
        <button
            @click="hideVoteCountdown()"
            class="bg-purple-500 hover:bg-purple-700 text-xs text-gray-100 py-2 px-4 rounded"
        >
            Hide Vote Countdown on Stream
        </button>
    </span>
</template>

<script>
    export default {
        methods: {
            showVoteCountdown() {
                axios.post('/output/vote-countdown-show', {seconds: 60})
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'The vote countdown is now being shown',
                            text: 'The actions was executed successfully.'
                        })
                    })
                    .catch(() => {
                        this.$notify({
                            type: 'error',
                            title: 'Whoops, something went wrong!',
                            text: 'The actions could not be executed successfully.'
                        })
                    })
            },
            hideVoteCountdown() {
                axios.post('/output/vote-countdown-hide', {seconds: 60})
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'The vote countdown is now being hidden',
                            text: 'The actions was executed successfully.'
                        })
                    })
                    .catch(() => {
                        this.$notify({
                            type: 'error',
                            title: 'Whoops, something went wrong!',
                            text: 'The actions could not be executed successfully.'
                        })
                    })
            }
        }
    }
</script>
