<template>
    <div class="flex">
        <div class="w-3/4 p-2">
            <div v-for="lowerThird in lowerThirds" class="rounded-md bg-gray-800 mx-4 my-2 p-2 flex items-center">
                <div class="w-1/2 font-bold">{{ lowerThird.name }}</div>
                <div class="flex-1">{{ lowerThird.title }}</div>
                <div>
                    <button
                        @click="showOnStream(lowerThird)"
                        class="bg-red-900 hover:bg-red-700 text-xs text-gray-100 py-2 px-4 rounded"
                    >
                        Show
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-purple-900 px-4 p-4">
            <input v-model="form.name" type="text" class="form-input w-full border-0 shadow bg-purple-700 mb-4 text-white" placeholder="Name">
            <input v-model="form.title" type="text" class="form-input w-full border-0 shadow bg-purple-700 mb-4 text-white" placeholder="Title">
            <div class="mt-2 flex justify-end items-center">
                <button @click="submit()" class="bg-purple-200 hover:bg-white text-base py-2 px-4 rounded text-black">
                    Add Lower Third
                </button>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['initialLowerThirds'],
    data() {
        return {
            lowerThirds: this.initialLowerThirds,
            form: { name: '', title: '' }
        }
    },
    methods: {
        submit() {
            this.lowerThirds.push(this.form)
            this.form = { name: '', title: '' }
        },
        showOnStream(lowerThird) {
            axios.post('/output/lowerthird/', lowerThird)
                .then(() => {
                    this.$notify({
                        type: 'success',
                        title: 'Lower third is now being shown',
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
