<template>
    <div class="bg-purple-900 p-4">
        <div class="flex items-center">
            <div class="flex-1 flex items-center mr-4">
                <textarea v-model="text" type="text" rows="3" class="flex-1 form-input border-0 shadow bg-purple-700 text-white" placeholder="Text (Markdown supported)..." />
            </div>

            <button @click="show()" class="bg-purple-200 hover:bg-white text-base py-2 px-4 rounded text-black">
                Show Message
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            text: '',
        }
    },
    methods: {
        show() {
            axios.post('/output/message', {text: this.text})
                .then(() => {
                    this.$notify({
                        type: 'success',
                        title: 'The message is now being shown',
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
