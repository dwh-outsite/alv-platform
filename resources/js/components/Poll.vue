<template>
    <div>
        <div class="p-4">
            <span class="font-bold">{{ poll.question }}</span>
            <div
                v-for="option in poll.options"
                @click="selected = option.id"
                class="mt-4 bg-gray-800 rounded-md p-4 flex items-center leading-5"
                :class="[
                    state == 'open' ? 'hover:bg-gray-700 cursor-pointer' : '',
                    state == 'open' && selected == option.id ? 'bg-purple-900 hover:bg-purple-800' : '',
                    state != 'open' && selected != option.id ? 'text-gray-600' : '',
                    state != 'open' && selected == option.id ? 'bg-purple-700' : '',
                ]"
            >
                <div v-if="selected == option.id" class="w-4 h-4 rounded border-2 border-gray-200 bg-gray-200 mr-4"></div>
                <div v-else class="w-4 h-4 rounded border-2 border-gray-600 mr-4"></div>
                <div class="flex-1">{{ option.answer }}</div>
            </div>
            <div class="flex justify-end">
                <button
                    @click="vote"
                    class="mt-4 bg-gray-700 font-bold p-4 rounded"
                    :class="selected && state == 'open' ? 'bg-purple-700 hover:bg-purple-500' : ''"
                    :disabled="!selected || state != 'open'"
                >
                    <span v-if="state == 'open'">Stem versturen</span>
                    <span v-if="state == 'loading'">Laden...</span>
                    <span v-if="state == 'submitted'">Je stem is verwerkt</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                state: 'open',
                selected: undefined,
                poll: {
                    id: 1,
                    question: 'Wat vind je van het jaarverslag?',
                    options: [
                        {
                            id: 1,
                            answer: 'Supermooi!'
                        },
                        {
                            id: 2,
                            answer: 'Mwahh'
                        },
                        {
                            id: 3,
                            answer: 'Ik zou het wel weten als ik een jaarverslag was'
                        },
                        {
                            id: 4,
                            answer: 'Geen mening'
                        }
                    ]
                }
            }
        },
        methods: {
            vote() {
                this.state = 'loading'

                axios.post('/polls/vote/' + this.selected)
                    .then(() => {
                        this.state = 'submitted'
                        this.$notify({
                            type: 'success',
                            title: 'Stem verzonden!',
                            text: 'Je stem is succcesvol verwerkt.'
                        })
                    })
                    .catch(error => {
                        this.state = 'open'
                        this.$notify({
                            type: 'error',
                            title: 'Oeps, er gings iets fout!',
                            text: error.response.data.error
                        })
                    })
                    .catch(() => {
                        this.state = 'open'
                        this.$notify({
                            type: 'error',
                            title: 'Oeps, er gings iets fout!',
                            text: 'De actie kon niet worden uitgevoerd'
                        })
                    })
            }
        }
    }
</script>
