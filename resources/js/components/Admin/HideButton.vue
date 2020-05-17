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
                            title: 'Er wordt niks meer weergegeven',
                            text: 'De actie is succesvol uitgevoerd.'
                        })
                    })
                    .catch(() => {
                        this.$notify({
                            type: 'error',
                            title: 'Oeps, er gings iets fout!',
                            text: 'De actie kon niet worden uitgevoerd.'
                        })
                    })
            }
        }
    }
</script>
