<template>
    <div class="absolute bottom-0 w-full text-gray-800">
        <div class="mx-auto w-1/2 pb-20">
            <div class="bg-white-transparent w-full p-6 py-8 porigin-top-left rounded-full text-center text-4xl">
                <span v-if="remainingSeconds > 0">
                Je hebt nog <strong v-text="remainingSeconds"/> seconden om te stemmen.
                </span>
                <span v-else>
                    Bedankt voor het stemmen!
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            remainingSeconds: 0,
            timer: undefined,
        }
    },
    methods: {
        start(seconds) {
            this.remainingSeconds = seconds
            clearInterval(this.timer)
            this.timer = setInterval(() => {
                if (this.remainingSeconds > 0) {
                    this.remainingSeconds--
                } else {
                    clearInterval(this.timer)
                    setTimeout(() => this.$emit('hide'), 2000)
                }
            }, 1000)
        }
    }
}
</script>
