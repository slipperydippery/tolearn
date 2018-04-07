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
					>
					</textarea>
				</div>

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
			</form>
		</div>
		<div class="edit-question--output">
			<h2 v-html="workQuestion.title"></h2>
			<div class="questionquestion" v-html="workQuestion.question"></div>
			<div class="questionanswer" v-html="workQuestion.answer"></div>
		</div>

	</div>
</template>

<script>
    import {store} from '../app.js';

    export default {
        props: [
        	'initquestion'
        ],

        data() {
            return {
            	'workQuestion': {'title': '', 'question': '', 'answer': ''}
            }
        },

        mounted() {
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
        	saveQuestion() {
        		axios.post('/api/question/' + this.initquestion.id + '/update', {
        			'question': this.workQuestion,
        		})
				.then(response => {
					this.baseQuestion = Object.assign({}, this.workQuestion);
				})
        	}
        }
    }
</script>