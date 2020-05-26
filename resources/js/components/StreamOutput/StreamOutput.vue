<template>
    <div class="text-white h-full relative overflow-hidden">
        <Logo />
        <transition name="slide-bottom">
            <LowerThird v-if="active == 'lowerThird' && lowerThirdActive" :data="data.lowerThird" />
        </transition>
        <transition name="slide-bottom">
            <Question v-if="active == 'question'" :data="data.question" />
        </transition>
        <transition name="slide-right">
            <Poll v-if="active == 'poll'" :data="data.poll" />
        </transition>
        <transition name="slide-right">
            <Agenda v-if="active == 'agenda'" />
        </transition>
    </div>
</template>

<script>
    import Logo from './Logo'
    import Agenda from './Agenda'
    import LowerThird from './LowerThird'
    import Question from './Question'
    import Poll from './Poll'

    export default {
        components: { Logo, Agenda, LowerThird, Question, Poll },
        data () {
            return {
                active: undefined,
                data: {
                    question: {},
                    poll: {},
                    lowerThird: { active: false }
                },
                lowerThirdActive: false,
                lowerThirdTimeOut: undefined
            }
        },
        mounted() {
            Echo.channel('stream-output').listen('StreamOutputHasChanged', event => {
                this.active = event.type
                this.data[event.type] = event.data

                if (event.type == 'lowerThird') {
                    this.lowerThirdActive = true

                    clearTimeout(this.lowerThirdTimeOut)

                    this.lowerThirdTimeOut = window.setTimeout(() => {
                        this.lowerThirdActive = false
                    }, 7000)
                }
            })
        }
    }
</script>
