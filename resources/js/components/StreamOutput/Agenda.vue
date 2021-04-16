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
                        <div v-if="typeof item === 'string'" class="p-4 font-semibold">{{ item }}</div>
                        <div v-else class="p-4">
                            <div class="font-semibold mb-4">{{ item.title }}</div>
                            <div class="space-y-2">
                                <div v-for="(subItem, i) in item.items" class="flex items-center">
                                    <div class="font-semibold rounded-full bg-purple-100 flex items-center justify-center mr-2 flex overflow-hidden">
                                        <div class="bg-purple-400 w-10 text-center py-2 pl-1 text-white font-bold">{{ i + 1 }}</div>
                                        <div class="pr-4 pl-2 py-2">{{ subItem }}</div>
                                    </div>
                                </div>
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
        components: { LogoColor },
        data () {
            return {
                agenda: [
                    'Opening',
                    'Vaststelling agenda',
                    'Vaststelling notulen',
                    'Mededelingen',
                    'Controlecommissie',
                    'Verhuur aan AEGEE',
                    'Benoeming bestuursleden',
                    'Rondvraag',
                    'Sluiting'
                ]
            }
        }
    }
</script>
