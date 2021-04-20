<template>
    <div class="text-white h-full relative overflow-hidden">
        <!--<Logo />-->
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
        <transition name="slide-left-right">
            <VoteCountdown ref="voteCountdown" v-show="voteCountdownActive" @hide="voteCountdownActive = false" />
        </transition>
    </div>
</template>

<script>
    import Logo from './Logo'
    import Agenda from './Agenda'
    import LowerThird from './LowerThird'
    import Question from './Question'
    import Poll from './Poll'
    import VoteCountdown from './VoteCountdown'

    export default {
        components: { Logo, Agenda, LowerThird, Question, Poll, VoteCountdown },
        data () {
            return {
                active: undefined,
                data: {
                    question: {},
                    poll: {},
                    lowerThird: { active: false },
                    voteCountdown: { seconds: 0 }
                },
                lowerThirdActive: false,
                lowerThirdTimeOut: undefined,
                voteCountdownActive: false
            }
        },
        mounted() {
            Echo.channel('stream-output').listen('StreamOutputHasChanged', event =>
                event.type.startsWith('voteCountdown')
                    ? this.handleVoteCountdownEvent(event)
                    : this.handleOutputChangeEvent(event)
            )
        },
        methods: {
            handleVoteCountdownEvent(event) {
                if (event.type.endsWith('Show')) {
                    this.voteCountdownActive = true
                    this.$refs.voteCountdown.start(event.data.seconds)
                } else {
                    this.voteCountdownActive = false
                }
            },
            handleOutputChangeEvent(event) {
                this.active = event.type
                this.data[event.type] = event.data

                if (event.type == 'lowerThird') {
                    this.lowerThirdActive = true

                    clearTimeout(this.lowerThirdTimeOut)

                    this.lowerThirdTimeOut = window.setTimeout(() => {
                        this.lowerThirdActive = false
                    }, 7000)
                }
            }
        }
    }
</script>
