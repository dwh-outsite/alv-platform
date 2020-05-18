<template>
    <div class="bg-purple-900 px-4 p-4">
        <input
            v-model="form.question" type="text"
            class="form-input w-full border-0 shadow bg-purple-700 mb-4 text-white" placeholder="Question"
        >
        <div v-for="(option, index) in form.options">
            <input
                v-model="form.options[index]" type="text"
                class="form-input w-full border-0 shadow bg-purple-700 my-1 text-white"
                :placeholder="'Option ' + (index + 1)"
            >
        </div>
        <div class="mt-2 flex justify-between items-center">
            <div class="text-xs cursor-pointer" @click="form.options.push('')">+ Add Option</div>
            <button @click="submit()" class="bg-purple-200 hover:bg-white text-base py-2 px-4 rounded text-black">
                Add Poll
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    question: '',
                    options: ['', '', '']
                }
            }
        },
        methods: {
            submit() {
                this.form.options = this.form.options.filter(option => option != '')

                axios.post('/polls', this.form)
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'Poll has been added',
                            text: 'The actions was executed successfully.'
                        })
                        this.form.question = ''
                        this.form.options = ['', '', '']
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
