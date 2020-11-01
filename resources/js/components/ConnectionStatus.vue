<template>
    <div class="bg-purple-100 p-2 rounded-md flex items-center">
        <div class="h-2 w-2 mr-2 rounded-full bg-purple-500"></div>
        <span class="text-purple-500 uppercase tracking-wider text-xs">
            Connected <span v-if="showParticipants">(~{{ participants.length }} participants)</span>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['showParticipants'],
        data() {
            return {
                participants: []
            }
        },
        mounted() {
            Echo.join('participants')
                .here(users => { this.participants = users })
                .joining(user => {
                    if (!this.participants.find(other => other.id == user.id && other.type == user.type)) {
                        this.participants.push(user)
                    }
                })
                .leaving(user => {
                    this.participants = _.reject(this.participants, other => other.id == user.id && other.type == user.type)
                })
        }
    }
</script>
