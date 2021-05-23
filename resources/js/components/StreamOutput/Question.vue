<template>
    <div class="absolute bottom-0 w-full text-gray-800">
        <div class="mx-auto w-4/5 pb-20">
            <div class="bg-white-transparent w-full origin-top-left rounded-lg relative">
                <p class="text-4xl leading-snug p-6" v-text="data.question" />
                <div class="text-white text-3xl bg-purple-500 px-4 flex items-center absolute top-0 h-12 -mt-6 ml-6 rounded-lg">
                    <div>
                        <strong>{{ data.name }}</strong>
                        vraagt
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data']
    }
</script>
