<template>
    <div>
        <div class="p-4 pb-0 text-sm">
            <strong>Please note:</strong>
            When someone opens multiple sessions (multiple browser tabs for example) and closes just one of them,
            the participant will be shown as "left" but in fact is still present using the other session.
        </div>
        <div
            v-for="participant in sortedPartipants"
            class="rounded m-4 p-2"
            :class="
                participant.present ?
                    (participant.type == 'admin' ? 'bg-purple-900' : 'bg-green-900')
                    : 'border border-gray-700 text-gray-700'
            "
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
