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
                <div
                    v-for="option in poll.options"
                    class="flex justify-between my-2 p-4 rounded border border-gray-700"
                    :class="votes.options.includes(option.id) ? 'bg-gray-700' : ''"
                >
                    {{ option.answer }}
                    <div class="flex items-center">
                        <div class="w-20 bg-gray-700 h-3">
                            <div class="bg-gray-500 h-full" :style="`width: ${percentage(option, poll.options)}%;`" />
                        </div>
                        <div class="w-12 text-right text-gray-500">{{ percentage(option, poll.options) }}%</div>
                        <div class="w-6 text-right">{{ option.votes }}</div>
                        <button
                            v-if="poll.status == 'open' && !votes.polls.includes(poll.id)"
                            @click="vote(poll.id, option.id)"
                            class="bg-purple-600 hover:bg-purple-400 text-sm text-gray-100 py-1 px-2 rounded ml-2"
                        >
                            Vote
                        </button>
                    </div>
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
                polls: this.initialPolls,
                votes: {
                    polls: [],
                    options: []
                }
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
                        title: 'The poll is now open for voting',
                        text: 'The actions was executed successfully.'
                    })
                })
            },
            closePoll(id) {
                this.changeStatus(id, 'closed', () => {
                    this.$notify({
                        type: 'success',
                        title: 'The poll is now closed',
                        text: 'The actions was executed successfully.'
                    })
                })
            },
            changeStatus(id, status, successCallback) {
                axios.put('/polls/' + id, {status})
                    .then(successCallback)
                    .catch(error => {
                        this.$notify({
                            type: 'error',
                            title: 'Whoops, something went wrong!',
                            text: 'The actions could not be executed successfully.'
                        })
                    })
            },
            vote(pollId, optionId) {
                axios.post('/polls/vote/' + optionId)
                    .then(() => {
                        this.votes.polls.push(pollId)
                        this.votes.options.push(optionId)
                        this.$notify({
                            type: 'success',
                            title: 'Voted!',
                            text: 'Your vote has been processed successfully.'
                        })
                    })
                    .catch(error => {
                        this.$notify({
                            type: 'error',
                            title: 'Whoops, something went wrong!',
                            text: error.response.data.error
                        })
                    })
            },
            showOnStream(id) {
                axios.post('/output/poll/' + id)
                    .then(() => {
                        this.$notify({
                            type: 'success',
                            title: 'The poll is now being shown',
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
            },
            percentage(option, options) {
                return Math.round(option.votes / options.reduce((votes, option) => votes + option.votes, 0) * 100)
            }
        }
    }
</script>
