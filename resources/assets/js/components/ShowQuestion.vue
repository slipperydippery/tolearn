<template>
	<div class="">
		<div class="row">
			<div class="col-12 main-container">
				<div class="questionquestion">
					<vue-markdown :source="question.question" v-if="question.question"></vue-markdown>
				</div>
			</div>
		</div>
		<div class="row useranswer--container">
			<div class="col-12 main-container">
				<div class="useranswer row">
					<div class="col-12">
					    <label for="useranswer"> <h3>Your answer</h3> </label>
				    </div>
					<div class="col-6">
						<div class="form-group">
							<textarea 
								id="useranswer"
				                class="form-control"
				                oninput='this.style.height = "";this.style.height = (this.scrollHeight + 3) + "px"'
				                ref="useranswer"			
								v-model="useranswer"
								placeholder="Use markdown" 
							>
							</textarea>
						</div>
					</div>
					<div class="col-6">
						<vue-markdown :source="useranswer" v-if="useranswer"></vue-markdown>	
					</div>
				</div>
				<div class="row hints" v-if="hints.length">
					<question-hint
						v-for="hint in hints"
						:hint="hint"
						:key="hint.id"
						:index="hints.indexOf(hint)"
					>
					</question-hint>
				</div>
				<div class="questionanswer" @click="toggleAnswer()"> 
					<h4 v-if="answerhidden">Reveal Answer</h4>
					<vue-markdown :source="question.answer" v-if="question.answer && ( ! answerhidden) "></vue-markdown>
				</div>
			</div>
			<div class="col-12 rateanswer main-container">
				<div class="guest" v-if="guest"> 
					<a href="/login" > Log in to rate your answer </a>
				</div>
				<div class="rateanswer--answer-container" v-else> 
					<span v-if="! answered">
						<i class="material-icons md-36 clickable rateanswer--answer answercorrect" @click="answerCorrect">check</i>
						<i class="material-icons md-36 clickable rateanswer--answer answerfalse" @click="answerFalse">close</i>
					</span>
					<span class="answernext--container">
						<span class="questionscore clickable" v-if="answered" @click>
							{{ correctCount }} / {{ answerCount }}
						</span>
						<i class="material-icons md-36 clickable rateanswer--answer answernext" @click="answerCorrect">chevron_right</i>
					</span>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import VueMarkdown from 'vue-markdown';

    export default {
        props: [
	        'question',
	        'guest',
	        'scorecardid'
        ],

	    components: {
	        VueMarkdown
	    },

        data() {
            return {
            	'hints': [],
            	'answers': [],
            	'useranswer': '',
            	'answerhidden': true,
		        'answered': false,
            }
        },

        mounted() {
        	this.getHints();
        	this.getAnswers();
        	this.$nextTick(() => {
        	    this.$refs.useranswer.focus();
        	})
        },

        computed: {
        	answerCount() {
        		return this.answers.length;
        	},

        	correctCount() {
        		let correctAnswers = this.answers.filter( answer => answer.correct );
        		return correctAnswers.length;
        	}
        },

        methods: {

        	getHints() {
        		axios.get('/api/question/' + this.question.id + '/hint')
        			.then(response => {
        				this.hints = response.data;
        			})
        	},

        	toggleAnswer() {
        		this.answerhidden = ! this.answerhidden;
        	},

        	answerCorrect() {
        		this.submitAnswer(true);
        	},

        	answerFalse() {
        		this.submitAnswer(false);
        	},

        	submitAnswer(answer) {
        		axios.post('/api/question/' + this.question.id + '/answer/store', {
        			'answer': answer,
        		})
        		.then(response => {
        			this.getAnswers();
        			this.answered = ! this.answered;
        		})
        	},

        	getAnswers() {
        		if(this.scorecardid != 0) {
	        		axios.get('/api/scorecard/' + this.scorecardid + '/answer')
	        			.then(response => {
	        				this.answers = response.data;
	        			});
    			}
        	}
        }
    }
</script>