<template>
    <div>
        <div v-for="poll in polls" class="bg-gray-800 rounded-md m-4">
            <div class="bg-gray-700 rounded-t-md p-4 font-bold text-lg flex justify-between items-center">
                <div>{{ poll.question }}</div>
                <div>
                    <button class="bg-red-900 hover:bg-red-700 text-base text-gray-100 py-2 px-4 rounded mr-4">
                        Show Results on Stream
                    </button>
                    <button class="bg-green-800 hover:bg-green-600 text-base text-gray-100 py-2 px-4 rounded">
                        Open Voting
                    </button>
                </div>
            </div>
            <div class="px-4 py-2">
                <div v-for="option in poll.options" class="flex justify-between my-2 p-4 rounded border border-gray-700">
                    <div>{{ option.answer }}</div>
                    <div>{{ option.votes }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['initialPolls'],
        data() {
            return {
                polls: this.initialPolls
            }
        }
    }
</script>
