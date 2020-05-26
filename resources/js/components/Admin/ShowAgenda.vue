<template>
    <button
        @click="showAgenda()"
        class="bg-purple-500 hover:bg-purple-700 text-xs text-gray-100 py-2 px-4 rounded"
    >
        Show Agenda on Stream
    </button>
</template>

<script>
    export default {
        methods: {
            showAgenda() {
                axios.post('/output/agenda')
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'The agenda is now being shown',
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
