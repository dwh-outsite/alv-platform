<template>
    <div>
        <div v-for="question in questions" class="rounded-md bg-gray-800 m-4 p-4">
            <div class="mb-2 flex justify-between">
                <strong>{{ question.participant.name }}</strong>
                <span class="text-gray-500">{{ new Date(question.created_at).toLocaleString() }}</span>
            </div>
            {{ question.question }}
        </div>
        <div>tst</div>
    </div>
</template>


<script>
    export default {
        props: ['initialQuestions'],
        data() {
            return {
                questions: this.initialQuestions
            }
        }
    }
</script>
