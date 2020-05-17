<template>
    <div class="text-white h-full relative overflow-hidden">
        <Logo />
        <transition name="slide-bottom">
            <LowerThird v-if="active == 'lowerThird'" :data="data.lowerThird" />
        </transition>
        <transition name="slide-bottom">
            <Question v-if="active == 'question'" :data="data.question" />
        </transition>
        <transition name="slide-right">
            <Poll v-if="active == 'poll'" :data="data.poll" />
        </transition>
    </div>
</template>

<script>
    import Logo from './Logo'
    import LowerThird from './LowerThird'
    import Question from './Question'
    import Poll from './Poll'

    export default {
        components: { Logo, LowerThird, Question, Poll },
        data () {
            return {
                active: undefined,
                data: {
                    question: {},
                    poll: {},
                    lowerThird: {}
                }
            }
        },
        mounted() {
            Echo.channel('stream-output').listen('StreamOutputHasChanged', event => {
                this.active = event.type
                this.data[event.type] = event.data
            })
        }
    }
</script>
