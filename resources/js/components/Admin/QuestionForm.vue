<template>
    <div class="bg-purple-900 px-4 p-4">
        <div class="mb-4 text-purple-200 italic">Manually add a new question that was for instance asked on another platform.</div>
        <input
            v-model="form.custom_name" type="text"
            class="form-input w-full border-0 shadow bg-purple-700 mb-4 text-white" placeholder="Name"
        >
        <textarea
            v-model="form.question"
            placeholder="Question"
            rows="3"
            class="form-input w-full border-0 shadow bg-purple-700 my-1 text-white"
        />
        <div class="mt-2 flex justify-end items-center">
            <button @click="submit()" class="bg-purple-200 hover:bg-white text-base py-2 px-4 rounded text-black">
                Add Question
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                custom_name: '',
                question: '',
            }
        }
    },
    methods: {
        submit() {
            axios.post('/admin/questions', this.form)
                .then(() => {
                    this.$notify({
                        type: 'success',
                        title: 'Question has been added',
                        text: 'The actions was executed successfully.'
                    })
                    this.form.custom_name = ''
                    this.form.question = ''
                    this.$emit('completed')
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
