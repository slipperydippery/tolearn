<template>
	<div class="row">
		<div class="col-12 edit-question--output main-container">
			<div class="row main-container--head">
				<div class="col-12">
					<h3> {{ question.title }} </h3>
				</div>
			</div>
			<div class="questionquestion">
				<vue-markdown :source="question.question" v-if="question.question"></vue-markdown>
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
		    <label for="useranswer">Your answer</label>
			<div class="useranswer row">
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
			<div class="questionanswer" @click="toggleAnswer()"> 
				<h4 v-if="answerhidden">Reveal Answer</h4>
				<vue-markdown :source="question.answer" v-if="question.answer && ( ! answerhidden) "></vue-markdown>
			</div>
			
		</div>
	</div>
</template>

<script>
    import VueMarkdown from 'vue-markdown';

    export default {
        props: [
	        'question'
        ],

	    components: {
	        VueMarkdown
	    },

        data() {
            return {
            	'hints': [],
            	'useranswer': '',
            	'answerhidden': true
            }
        },

        mounted() {
        	this.getHints();
        },

        computed: {
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
        	}
        }
    }
</script>