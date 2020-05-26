<template>
    <div class="absolute right-0 text-gray-800 h-full">
        <div class="h-full relative">
            <LogoColor />
            <div class="h-full pl-12 border-l-16 border-purple-500 origin-top-left transform skew-x-1.5 bg-white-transparent">
                <div class="transform -skew-x-1.5 origin-top-left h-full w-96 mr-12 pt-40">
                    <div class="inline bg-purple-500 rounded-full px-3 py-2 tracking-wider text-white uppercase font-bold text-xl">
                        ALV
                    </div>
                    <h2 class="mt-6 mb-6 text-5xl leading-tight">Agenda</h2>
                    <div v-for="(item, i) in agenda" class="bg-purple-200 rounded mb-4 text-2xl flex text-purple-900">
                        <div class="rounded-l bg-purple-500 p-4 text-white w-16 text-center font-bold">
                            {{ i + 1 }}
                        </div>
                        <div class="p-4 font-semibold">{{ item }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LogoColor from './LogoColor'

    export default {
        components: { LogoColor },
        data () {
            return {
                data: {
                    question: 'test',
                    options: [
                        {answer: 'hi', votes: 3}
                    ]
                },
                agenda: [
                    'Opening',
                    'Agendavaststelling',
                    'Mededelingen',
                    'Vaststellen notulen',
                    'Jaarverslag 2019',
                    'Jaarrekening 2019',
                    'Decharge',
                    'Kascontrolecommissie',
                    'Begrotingswijziging',
                    'Rondvraag',
                    'Sluiting'
                ]
            }
        }
    }
</script>
