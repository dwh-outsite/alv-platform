<template>
    <div>
        <div
            v-for="participant in sortedPartipants"
            class="rounded m-4 p-2"
            :class="participant.present ? 'bg-green-900' : 'border border-gray-700 text-gray-700'"
        >
            {{ participant.name }}
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                participants: []
            }
        },
        mounted() {
            Echo.join('participants')
                .here(users => {
                    this.participants = users.map(user => {
                        return {present: true, ...user}
                    })
                })
                .joining(user => {
                    if (this.participants.find(other => other.id == user.id && other.type == user.type)) {
                        this.participants.find(other => other.id == user.id && other.type == user.type).present = true
                    } else {
                        this.participants.push({present: true, ...user})
                    }
                })
                .leaving(user => {
                    this.participants.find(other => other.id == user.id && other.type == user.type).present = false
                })
        },
        computed: {
            sortedPartipants() {
                return this.participants.sort((a, b) => b.present - a.present)
            }
        }
    }
</script>
