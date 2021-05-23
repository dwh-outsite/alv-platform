<template>
    <div class="absolute right-0 text-gray-800 h-full">
        <div class="h-full relative">
            <LogoColor />
            <div class="h-full pl-12 border-l-16 border-purple-400 origin-top-left transform skew-x-1.5 bg-white">
                <div class="transform -skew-x-1.5 origin-top-left h-full w-96 mr-12 pt-48 flex flex-col">
                    <div class="flex-1">
                        <div class="inline bg-purple-400 rounded-full px-3 py-2 tracking-wider text-white uppercase font-bold text-xl">
                            Poll
                        </div>
                        <h2 class="mt-6 text-5xl leading-tight">{{ data.question }}</h2>
                        <div class="mt-16">
                            <div class="mt-8 bg-purple-200 p-4 rounded-lg text-3xl" v-for="option in data.options">
                                {{ option.answer }}
                            </div>
                        </div>
                    </div>
                    <div class="text-purple-400 pb-12 text-4xl leading-tight">
                        Stem nu op <strong>alv.dwhdelft.nl</strong>
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
