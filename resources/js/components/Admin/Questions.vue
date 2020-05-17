<template>
    <div>
        <div v-for="question in questions" class="rounded-md bg-gray-800 m-4 p-4">
            <div class="flex justify-between">
                <div>
                    <div class="font-bold mb-2">{{ question.participant.name }}</div>
                    {{ question.question }}
                </div>
                <div class="text-right">
                    <div class="text-gray-500 mb-2">{{ new Date(question.created_at).toLocaleString() }}</div>
                    <button
                        @click="showOnStream(question.id)"
                        class="bg-red-900 hover:bg-red-700 text-xs text-gray-100 py-2 px-4 rounded"
                    >
                        Show on Stream
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['initialQuestions'],
        data() {
            return {
                questions: this.initialQuestions
            }
        },
        mounted() {
            Echo.private('questions').listen('QuestionWasAsked', event => {
                this.questions.unshift(event.question)
            })
        },
        methods: {
            showOnStream(id) {
                axios.post('/output/question/' + id)
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'Poll wordt nu getoond',
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
