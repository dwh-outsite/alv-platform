<template>
    <div class="absolute top-0 w-full text-gray-800">
        <div class="pt-10">
            <div class="origin-top-left inline-block flex items-center text-3xl leading-snug">
                <div v-html="data.text" class="bg-white p-6 rounded-r-lg"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data']
}
</script>
