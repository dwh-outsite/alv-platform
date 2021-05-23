<template>
    <div>
        <div class="absolute top-0 w-full text-gray-800">
            <div class="pt-10">
                <div class="origin-top-left inline-block flex items-center text-3xl leading-snug">
                    <div class="bg-purple-500 text-white uppercase tracking-wide p-6 font-bold">
                        Straks
                    </div>
                    <div class="bg-white p-6 rounded-r-lg">
                        <strong>
                            {{ data.name }}
                        </strong>
                        <span class="mx-1">begint over</span>
                        <span v-if="hours > 0" class="same-width-digits text-purple-500 font-semibold">
                            {{ hours | twoDigits }}:{{ minutes | twoDigits }}:{{ seconds | twoDigits }} uur
                        </span>
                        <span v-else class="same-width-digits text-purple-500 font-semibold">
                            {{ minutes | twoDigits }}:{{ seconds | twoDigits }} minuten
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let interval = null
export default {
    filters: {
        twoDigits(value) {
            if (value.toString().length <= 1) {
                return '0' + value.toString()
            }
            return value.toString()
        }
    },
    props: ['data'],
    data() {
        return {
            now: Math.trunc(new Date().getTime() / 1000),
            date: this.data.time,
            diff: 0,
            interval: null
        }
    },
    computed: {
        seconds() {
            return Math.trunc(this.diff) % 60
        },
        minutes() {
            return Math.trunc(this.diff / 60) % 60
        },
        hours() {
            return Math.trunc(this.diff / 60 / 60) % 24
        },
        days() {
            return Math.trunc(this.diff / 60 / 60 / 24)
        }
    },
    watch: {
        now(value) {
            this.diff = this.date - this.now
            if (this.diff < 0 || this.stop) {
                this.diff = 0
                this.$emit('hide')
            }
        },
        data: {
            deep: true,
            handler(value) {
                this.date = value.time
                this.now = Math.trunc(new Date().getTime() / 1000)
                this.diff = this.date - this.now
            }
        }
    },
    mounted() {
        interval = setInterval(() => {
            this.now = Math.trunc(new Date().getTime() / 1000)
        }, 1000)
    },
    destroyed() {
        clearInterval(interval)
    }
}
</script>

<style>
.same-width-digits {
    font-variant-numeric: tabular-nums;
}
</style>
