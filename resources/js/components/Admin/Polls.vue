<template>
    <div>
        <PollForm/>
        <div v-for="poll in polls" class="bg-gray-800 rounded-md m-4">
            <div
                class="rounded-t-md p-4 font-bold text-lg flex justify-between items-center"
                :class="poll.status == 'open' ? 'bg-green-600' : 'bg-gray-700'"
            >
                <div>{{ poll.question }}</div>
                <div>
                    <button
                        @click="showOnStream(poll.id)"
                        class="bg-red-900 hover:bg-red-700 text-base text-gray-100 py-2 px-4 rounded mr-2"
                    >
                        Show Results on Stream
                    </button>
                    <button
                        v-if="poll.status == 'open'"
                        @click="closePoll(poll.id)"
                        class="bg-green-800 hover:bg-green-600 text-base text-gray-100 py-2 px-4 rounded"
                    >
                        Close Voting
                    </button>
                    <button
                        v-else
                        @click="openPoll(poll.id)"
                        class="bg-green-800 hover:bg-green-600 text-base text-gray-100 py-2 px-4 rounded"
                    >
                        Open Voting
                    </button>
                </div>
            </div>
            <div class="px-4 py-2">
                <div v-for="option in poll.options"
                     class="flex justify-between my-2 p-4 rounded border border-gray-700">
                    <div>{{ option.answer }}</div>
                    <div>{{ option.votes }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PollForm from './PollForm'

    export default {
        components: {PollForm},
        props: ['initialPolls'],
        data() {
            return {
                polls: this.initialPolls
            }
        },
        mounted() {
            Echo.private('polls').listen('PollStatusHasChanged', event => {
                this.polls.find(poll => poll.id == event.poll.id).status = event.poll.status
            })
            Echo.private('admin-polls').listen('PollVotesHaveChanged', event => {
                this.polls.find(poll => poll.id == event.poll.id).options = event.poll.options
            })
            Echo.private('admin-polls').listen('PollWasAdded', event => {
                this.polls.unshift(event.poll)
            })
        },
        methods: {
            openPoll(id) {
                this.changeStatus(id, 'open', () => {
                    this.$notify({
                        type: 'success',
                        title: 'Poll is nu geopend',
                        text: 'De actie is succesvol uitgevoerd.'
                    })
                })
            },
            closePoll(id) {
                this.changeStatus(id, 'closed', () => {
                    this.$notify({
                        type: 'success',
                        title: 'Poll is nu gesloten',
                        text: 'De actie is succesvol uitgevoerd.'
                    })
                })
            },
            changeStatus(id, status, successCallback) {
                axios.put('/polls/' + id, {status})
                    .then(successCallback)
                    .catch(error => {
                        this.$notify({
                            type: 'error',
                            title: 'Oeps, er gings iets fout!',
                            text: 'De actie kon niet worden uitgevoerd.'
                        })
                    })
            },
            showOnStream(id) {
                axios.post('/output/poll/' + id)
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
