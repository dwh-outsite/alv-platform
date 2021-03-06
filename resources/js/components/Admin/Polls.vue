<template>
    <div>
        <div class="bg-gray-800 text-right py-2 px-4" @click="showForm = !showForm">
            <Zondicon v-if="!showForm" icon="add-outline" class="w-6 h-6 fill-current inline text-gray-500 hover:text-gray-200 cursor-pointer" />
            <Zondicon v-else icon="close" class="w-6 h-6 fill-current inline text-gray-500 hover:text-gray-200 cursor-pointer" />
        </div>
        <PollForm v-if="showForm" />
        <div v-for="poll in polls" class="bg-gray-800 rounded-md m-4">
            <div
                class="rounded-t-md px-4 py-2 font-bold text-lg flex justify-between items-center"
                :class="poll.status == 'open' ? 'bg-green-600' : 'bg-gray-700'"
            >
                <div>{{ poll.question }}</div>
                <div class="flex items-center">
                    <button
                        @click="showOnStream(poll.id)"
                        class="bg-red-900 hover:bg-red-700 text-xs text-gray-100 p-2 rounded mr-2 uppercase tracking-wide font-semibold"
                    >
                        Show on Stream
                    </button>
                    <button
                        @click="showResultsOnStream(poll.id)"
                        class="bg-red-900 hover:bg-red-700 text-xs text-gray-100 p-2 rounded mr-2 uppercase tracking-wide font-semibold"
                    >
                        Show Results on Stream
                    </button>
                    <button
                        v-if="poll.status == 'open'"
                        @click="closePoll(poll.id)"
                        class="bg-green-800 hover:bg-green-600 text-xs text-gray-100 py-2 px-4 rounded uppercase tracking-wide font-semibold"
                    >
                        Close Voting
                    </button>
                    <button
                        v-else
                        @click="openPoll(poll.id)"
                        class="bg-green-800 hover:bg-green-600 text-xs text-gray-100 py-2 px-4 rounded uppercase tracking-wide font-semibold"
                    >
                        Open Voting
                    </button>
                </div>
            </div>
            <div class="px-4 py-2">
                <div
                    v-for="option in poll.options"
                    class="flex items-center justify-between my-2 p-3 rounded border border-gray-700"
                >
                    <div>{{ option.answer }}</div>
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
import Zondicon from 'vue-zondicons'
import PollForm from './PollForm'

export default {
    components: { PollForm, Zondicon },
    props: ['initialPolls'],
    data() {
        return {
            polls: this.initialPolls,
            showForm: false,
            votes: {
                polls: [],
                options: [],
            },
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
            axios.put('/admin/polls/' + id, {status})
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
            axios.post('/output/poll-question/' + id)
                .then(() => {
                    this.$notify({
                        type: 'success',
                        title: 'The poll question is now being shown',
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
        showResultsOnStream(id) {
            axios.post('/output/poll/' + id)
                .then(() => {
                    this.$notify({
                        type: 'success',
                        title: 'The poll results are now being shown',
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
