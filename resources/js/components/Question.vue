<template>
    <div class="h-full flex flex-col p-4 text-gray-100 min-h-48">
        <div
            v-if="state == 'submitted'"
            class="flex-1 mb-2 form-input border-0 shadow bg-green-800 flex items-center justify-center"
        >
            <div class="text-center">
                <div class="font-bold">Bedankt voor je vraag!</div>
                We beantwoorden je vraag zo snel mogelijk
            </div>
        </div>
        <textarea
            v-if="state == 'available' || state == 'loading'"
            v-model="question"
            class="flex-1 mb-2 form-input border-0 shadow bg-gray-800"
            placeholder="Schrijf hier je vraag en klik daarna op versturen ..."
        />
        <button
            v-if="state == 'available' || state == 'loading'"
            @click="submit"
            class="bg-gray-700 font-bold py-3 px-6 rounded leading-relaxed"
            :class="question != '' ? 'bg-purple-700 hover:bg-purple-500' : ''"
            :disabled="state !== 'available' || question == ''"
        >
            Vraag versturen
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                state: 'available',
                question: ''
            }
        },
        methods: {
            submit() {
                this.state = 'loading'

                axios.post('/questions', {question: this.question})
                    .then(() => {
                        this.question = ''
                        this.state = 'submitted'
                        window.setTimeout(() => { this.state = 'available'}, 2500)
                        this.$notify({
                            type: 'success',
                            title: 'Vraag verzonden!',
                            text: 'We beantwoorden je vraag zo snel mogelijk'
                        })
                    })
                    .catch(error => {
                        this.state = 'available'
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
