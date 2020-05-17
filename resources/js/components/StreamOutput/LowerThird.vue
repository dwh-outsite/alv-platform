<template>
    <div class="absolute bottom-0 w-full text-gray-800">
        <div class="bg-white-transparent w-full pl-16 pb-8 border-t-16 border-purple-500 origin-top-left transform skew-y-1.5">
            <div class="transform -skew-y-1.5 h-full pt-2 pb-6">
                <h1 class="text-5xl font-bold text-purple-500" v-text="data.name" />
                <p class="mt-2 text-3xl" v-text="data.title" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data']
    }
</script>
