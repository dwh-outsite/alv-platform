<template>
    <div>
        <div class="bg-gray-800 text-right py-2 px-4" @click="showForm = !showForm">
            <Zondicon v-if="!showForm" icon="add-outline" class="w-6 h-6 fill-current inline text-gray-500 hover:text-gray-200 cursor-pointer" />
            <Zondicon v-else icon="close" class="w-6 h-6 fill-current inline text-gray-500 hover:text-gray-200 cursor-pointer" />
        </div>
        <QuestionForm v-if="showForm" @completed="showForm = false" />
        <div v-for="question in questions" class="rounded-md bg-gray-800 m-4 p-4">
            <div class="flex justify-between">
                <div>
                    <div class="font-bold mb-2">
                        <div v-if="question.participant">
                            <a :href="'/admin/participant/' + question.participant.id" class="text-purple-400">
                                {{ question.name }}
                            </a>
                        </div>
                        <div v-else>
                            {{ question.name }}
                        </div>
                    </div>
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
import Zondicon from 'vue-zondicons'
import QuestionForm from "./QuestionForm"

export default {
    props: ['initialQuestions'],
    components: { Zondicon, QuestionForm },
    data() {
        return {
            showForm: false,
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
                        title: 'Question is now being shown',
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
