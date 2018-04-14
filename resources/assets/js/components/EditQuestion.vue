<template>
	<div class="edit-question">
		<div class="edit-question--input">
			<form>
				<div class="form-group">
				    <label for="questiontitle">Question Title</label>
					<input id="questiontitle" class="form-control" type="text" v-model="workQuestion.title" ref="titleinput">
				</div>

				<edit-question-tags
					:initquestion="initquestion"
				>
				</edit-question-tags>

				<div class="form-group">
				    <label for="questionquestion">Question</label>
					<textarea 
						id="questionquestion"
		                class="form-control"
		                oninput='this.style.height = "";this.style.height = (this.scrollHeight + 3) + "px"'
		                ref="questioninput"			
						v-model="workQuestion.question"
						placeholder="Use ``` to start and end a code-block, use ` to start and end inline code" 
					>
					</textarea>
				</div>

				<edit-question-hints
					:initquestion="initquestion"
					:savecounter="savecounter"
					@updatehints="getHints()"
				>
				</edit-question-hints>

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
				<button class="btn btn-primary" @click.prevent="saveQuestion">Save Question</button>
				<button class="btn btn-primary" @click.prevent="createFollowup">Add a Followup Question</button>
			</form>
		</div>
		<div class="edit-question--output">
			<h2 v-html="workQuestion.title"></h2>
			<div class="questionquestion">

				<span 
					v-for="string in sortBoi(workQuestion.question)" 
					:key="sortBoi(workQuestion.question).indexOf(string)"
					class="textboi--block"
					:class=" {'code--block code' : ( sortBoi(workQuestion.question).indexOf(string) % 2 )} "
				>
					<span 
						v-for="(paragraph, index) in codeBoi(string)"
						:class=" { 'code__last': index == codeBoi(string).length - 1 } "
						v-if="sortBoi(workQuestion.question).indexOf(string) % 2" 
					>
						<span v-for="n in (paragraph.spacecount + paragraph.tabcount)">&nbsp;&nbsp;&nbsp;&nbsp;</span>{{ paragraph.text }} <br>
					</span>
					<span v-if="! (sortBoi(workQuestion.question).indexOf(string) % 2)">
						<p v-for="paragraph in textBoi(string)">
							<template v-for="string in inlineBoi(paragraph)"> 
								<span v-if="inlineBoi(paragraph).indexOf(string) % 2" class="code"> {{ string }} </span>
								<template v-else> {{ string }} </template>
							</template>
						</p>
					</span>

				</span>
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
			<div class="questionanswer"> <p>{{ workQuestion.answer }}</p> </div>
		</div>

	</div>
</template>

<script>
    export default {
        props: [
        	'initquestion'
        ],

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