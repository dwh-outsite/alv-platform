<template>
    <div class="text-white h-full relative overflow-hidden">
        <!--<Logo />-->
        <transition name="slide-bottom">
            <LowerThird v-if="active == 'lowerThird' && lowerThirdActive" :data="data.lowerThird" />
        </transition>
        <transition name="slide-bottom">
            <Question v-if="active == 'question'" :data="data.question" />
        </transition>
        <transition name="slide-bottom">
            <Message v-if="active == 'message'" :data="data.message" />
        </transition>
        <transition name="slide-right">
            <PollQuestion v-if="active == 'poll-question'" :data="data['poll-question']" />
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
        <transition name="slide-left">
            <Countdown v-show="upperLeft == 'countdown'" @hide="upperLeft == 'countdown' ? upperLeft = undefined : {}" :data="data.countdown" />
        </transition>
        <transition name="slide-left">
            <UpperThird v-show="upperLeft == 'upperThird'" :data="data.upperThird" />
        </transition>
    </div>
</template>

<script>
    import Logo from './Logo'
    import Agenda from './Agenda'
    import LowerThird from './LowerThird'
    import Question from './Question'
    import Poll from './Poll'
    import PollQuestion from './PollQuestion'
    import VoteCountdown from './VoteCountdown'
    import Message from './Message'
    import Countdown from './Countdown'
    import UpperThird from './UpperThird'

    export default {
        components: { Logo, Agenda, LowerThird, Question, Poll, PollQuestion, VoteCountdown, Message, Countdown, UpperThird },
        data () {
            return {
                active: undefined,
                data: {
                    question: {},
                    poll: {},
                    'poll-question': {},
                    lowerThird: { active: false },
                    voteCountdown: { seconds: 0 },
                    message: {},
                    countdown: { time: '' },
                    upperThird: {},
                },
                lowerThirdActive: false,
                lowerThirdTimeOut: undefined,
                voteCountdownActive: false,
                upperLeft: undefined,
            }
        },
        mounted() {
            Echo.channel('stream-output').listen('StreamOutputHasChanged', event =>
                event.type && event.type.startsWith('voteCountdown')
                    ? this.handleVoteCountdownEvent(event)
                    : this.handleOutputChangeEvent(event)
            )
            Echo.channel('stream-output').listen('StreamOutputCountdownHasStarted', event => {
                this.upperLeft = 'countdown'
                this.data.countdown = event.data
            })
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

                if (event.type === 'upperThird') {
                    this.upperLeft = 'upperThird'
                    return
                }

                if (event.type == 'lowerThird') {
                    this.lowerThirdActive = true

                    clearTimeout(this.lowerThirdTimeOut)

                    this.lowerThirdTimeOut = window.setTimeout(() => {
                        this.lowerThirdActive = false
                    }, 7000)
                }

                if (!event.type) {
                    this.upperLeft = undefined
                }
            }
        }
    }
</script>
