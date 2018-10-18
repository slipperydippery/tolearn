<template>
	<div class="row edit-question">
		<div class="col-12 edit-question--input main-container">
			<form>

                <div class="form-group">
                    <textarea 
                        id="questionquestion"
                        class="form-control"
                        oninput='this.style.height = "";this.style.height = (this.scrollHeight + 3) + "px"'
                        ref="questioninput"         
                        v-model="workQuestion.question"
                        v-b-tooltip.hover
                        title="Use ``` to start and end a code-block, use ` to start and end inline code"
                        placeholder="Question" 
                    >
                    </textarea>
                </div>

				<edit-question-tags
					:initquestion="initquestion"
				>
				</edit-question-tags>

                <div class="form-group">    
                    <label for="questionanswer">Answer</label>
                    <textarea 
                        id="questionanswer"
                        class="form-control"
                        oninput='this.style.height = "";this.style.height = (this.scrollHeight + 3) + "px"'
                        ref="answerinput"           
                        v-model="workQuestion.answer"
                    >
                    </textarea>
                </div>

				<edit-question-hints
					:initquestion="initquestion"
					:savecounter="savecounter"
					@updatehints="getHints()"
				>
				</edit-question-hints>
				<button class="btn btn-primary" @click.prevent="saveQuestion">Save Question</button>
			</form>
		</div>

		<div class="col-12 edit-question--output main-container">
			<div class="row main-container--head">
				<div class="col-12">
					<h3> {{ workQuestion.title }} </h3>
				</div>
			</div>
			<div class="questionquestion">
				<vue-markdown :source="workQuestion.question" v-if="workQuestion.question"></vue-markdown>
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
			<div class="questionanswer"> 
				<vue-markdown :source="workQuestion.answer" v-if="workQuestion.answer"></vue-markdown>
			</div>
			
		</div>

	</div>
</template>


<script>
    import VueMarkdown from 'vue-markdown';

    export default {
        props: [
        	'initquestion'
        ],	

	    components: {
	        VueMarkdown
	    },

        data() {
            return {
            	'workQuestion': {'title': '', 'question': '', 'answer': ''},
            	'savecounter': 0,
            	'hints': []
            }
        },

        mounted() {
        	this.getHints();
            this.workQuestion = Object.assign({}, this.initquestion);
            this.baseQuestion = Object.assign({}, this.initquestion);
            this.$nextTick(() => {
                this.$refs.questioninput.style.height = (this.$refs.questioninput.scrollHeight + 3) + 'px';
                this.$refs.answerinput.style.height = (this.$refs.answerinput.scrollHeight + 3) + 'px';
            })
        },

        computed: {
        },

        methods: {
            textBoi(input) {
                if(input){
                    let paragraphs = [];
                    input.split("\n").forEach(function(text){
                        if(text.trim()){
                            paragraphs.push(text);
                        }
                    })
                    return paragraphs;
                }
            },

            sortBoi(input) {
            	if(input){
            		let paragraphs = [];
            		input.split('```').forEach(function(text){
           				paragraphs.push(text);
            		});
            		return paragraphs;
            	}
            },

            codeBoi(input) {
                if(input){
                    let paragraphs = [];
                    input.split("\n").forEach(function(text){
                    	let tabcount = (text.match(/\t/g) || []).length;
                    	text = text.replace(/\t/g, '');
                    	let spacecount = Math.floor(text.search(/\S|$/) / 4);
                    	if(text.trim()){
							paragraphs.push({
								'spacecount': spacecount,
								'tabcount': tabcount,
								'text': text,
							});
						}
                    })
                    return paragraphs;
                }
            },

            inlineBoi(input) {
            	if(input){
            		let paragraphs = [];
            		paragraphs = input.split('`');
            		return paragraphs;
            	}
            },

        	saveQuestion() {
        		axios.post('/api/question/' + this.initquestion.id + '/update', {
        			'question': this.workQuestion,
        		})
				.then(response => {
					this.baseQuestion = Object.assign({}, this.workQuestion);
					this.savecounter ++;
				})
        	},

        	createFollowup() {
        		axios.post('/api/question/store', {
        			'parent': this.workQuestion
        		})
        	},

        	getHints() {
        		axios.get('/api/question/' + this.initquestion.id + '/hint')
        			.then(response => {
        				this.hints = response.data;
        			})
        	},
        }
    }
</script>