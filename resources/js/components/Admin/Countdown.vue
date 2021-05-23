<template>
    <div class="bg-purple-900 p-4">
        <div class="flex items-center">
            <div class="flex-1 flex items-center mr-4">
                <input v-model="name" type="text" class="flex-1 form-input border-0 shadow bg-purple-700 text-white" placeholder="Show Name">
                <span class="mx-2">starts at</span>
                <input v-model="hour" type="text" class="w-12 form-input border-0 shadow bg-purple-700 text-white" placeholder="Hour">
                <span class="mx-2">:</span>
                <input v-model="minutes" type="text" class="w-12 form-input border-0 shadow bg-purple-700 text-white" placeholder="Seconds">
            </div>

            <button @click="show()" class="bg-purple-200 hover:bg-white text-base py-2 px-4 rounded text-black">
                Show Countdown
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            hour: new Date().getHours(),
            minutes: new Date().getMinutes() + 1,
        }
    },
    methods: {
        show() {
            axios.post('/output/countdown', {name: this.name, hour: this.hour, minutes: this.minutes})
                .then(() => {
                    this.$notify({
                        type: 'success',
                        title: 'The countdown is now being shown',
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
        }
    }
}
</script>
