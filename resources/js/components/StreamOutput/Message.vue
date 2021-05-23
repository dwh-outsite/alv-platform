<template>
    <div class="absolute bottom-0 w-full text-gray-800">
        <div class="mx-auto w-4/5 pb-20">
            <div class="bg-white-transparent w-full origin-top-left rounded-lg">
                <div class="text-4xl leading-snug p-6" v-html="data.text" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data']
}
</script>
