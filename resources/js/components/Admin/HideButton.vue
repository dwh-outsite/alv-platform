<template>
    <button
        @click="hideAll()"
        class="bg-red-900 hover:bg-red-700 text-xs text-gray-100 py-2 px-4 rounded"
    >
        Hide All on Stream
    </button>
</template>

<script>
    export default {
        props: ['initialQuestions'],
        methods: {
            hideAll() {
                axios.post('/output/hide')
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'All components are now hidden',
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
