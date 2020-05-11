<template>
    <div class="bg-purple-100 p-2 rounded-md flex items-center">
        <div class="h-2 w-2 mr-2 rounded-full bg-purple-500"></div>
        <span class="text-purple-500 uppercase tracking-wider text-xs">
            Connected ({{ participantsCount }} participants)
        </span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                participantsCount: 0
            }
        },
        mounted() {
            Echo.join('participants')
                .here(users => { this.participantsCount = users.length })
                .joining(user => { this.participantsCount++ })
                .leaving(user => { this.participantsCount-- })
        }
    }
</script>
