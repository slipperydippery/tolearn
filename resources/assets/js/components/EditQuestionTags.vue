<template>
	<div class="question-tags">
		<div class="btn-group-toggle" >
			<label class="btn btn-secondary" :class="{ 'active' : isChecked(tag) }" v-for="tag in tags">
				<input type="checkbox" :checked="isChecked(tag)" autocomplete="off" @click.prevent="toggleTag(tag)"> {{ tag.name }}
			</label>
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
            	'tags': [],
            	'questiontags': [],
            }
        },

        mounted() {
        	this.getTags();
        	this.getQuestionTags();
        },

        computed: {
        },

        methods: {
        	getTags() {
	        	axios.get('/api/tag')
		        	.then(response => {
		        		this.tags = response.data;
		        	})
        	},

        	getQuestionTags() {
        		axios.get('/api/question/' + this.initquestion.id + '/tag')
        			.then(response => {
        				this.questiontags = response.data;
        			})
        	},

        	isChecked(tag) {
        		if(this.questiontags.map( tag => tag.name ).includes(tag.name)){
        			return true;
        		}
        		return false;
        	},

        	toggleTag(tag) {
        		if(this.isChecked(tag)) {
        			axios.get('/api/question/' + this.initquestion.id + '/tag/' + tag.id + '/destroy')
	        			.then(response => {
	        				this.getQuestionTags();
	        			})
        		} else {
        		axios.post('/api/question/' + this.initquestion.id + '/tag/store', {
	        			'tag': tag
	        		})
        			.then(response => {
        				this.questiontags.push(response.data);
        			})
				}        		
        	}
        }
    }
</script>