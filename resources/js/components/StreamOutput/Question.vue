<template>
    <div class="absolute bottom-0 w-full text-gray-800">
        <div class="mx-auto w-2/3 pb-20">
            <div class="bg-white-transparent w-full p-6 pt-4 border-t-16 border-purple-500 origin-top-left rounded-lg">
                <p class="text-3xl leading-snug" v-text="data.question" />
                <div class="text-gray-600 text-2xl text-right" v-text="data.author" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data']
    }
</script>
