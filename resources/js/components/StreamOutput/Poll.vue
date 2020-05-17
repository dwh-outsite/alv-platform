<template>
    <div class="absolute right-0 text-gray-800 h-full">
        <div class="h-full relative">
            <LogoColor />
            <div class="h-full pl-12 border-l-16 border-purple-500 origin-top-left transform skew-x-1.5 bg-white-transparent">
                <div class="transform -skew-x-1.5 origin-top-left h-full w-96 mr-12 pt-40">
                    <div class="inline bg-purple-500 rounded-full px-3 py-2 tracking-wider text-white uppercase font-bold text-xl">
                        Uitslag
                    </div>
                    <h2 class="mt-6 text-5xl leading-tight">{{ data.question }}</h2>
                    <div class="">
                        <div class="mt-8" v-for="option in data.options">
                            <div class="mb-3 flex justify-between text-3xl">
                                <div>{{ option.answer }}</div>
                                <div class="text-purple-500 font-bold">{{ option.votes }}</div>
                            </div>
                            <div class="bg-purple-200 h-6 w-full rounded">
                                <div class="h-full bg-purple-500 rounded-l" :style="'width: ' + percentage(option.votes) + '%'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LogoColor from './LogoColor'

    export default {
        props: ['data'],
        components: { LogoColor },
        methods: {
            percentage(votes) {
                const total = this.data.options.reduce((sum, option) => sum + option.votes, 0)

                return votes / total * 100
            }
        }
    }
</script>
