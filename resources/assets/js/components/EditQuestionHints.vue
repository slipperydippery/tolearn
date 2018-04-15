<template>
	<div class="hints--input">
		<div class="form-group" v-if="hints">
		    <label for="questionquestion">Hints</label>
		    <div class="hints--input--single row" v-for="hint in hints">
		    	<div class="col-11">
					<input id="questionhint" class="form-control" type="text" v-model="hint.hint" ref="hintinput" required>
				</div>
				<div class="col-1">
					<button class="btn btn-danger btn-sm" @click.prevent="removeHint(hint)">X</button>
				</div>
		    </div>
        </div>
		<button class="btn btn-outline-primary btn-margin-bottom" @click.prevent="addHint()">+ Hint</button>
	</div>
</template>

<script>
    export default {
        props: [
        	'initquestion',
        	'savecounter'
        ],

        data() {
            return {
            	'hints': [],
            	'hintsToDelete': [],
            }
        },

        mounted() {
        	this.getHints();
        },

        watch: {
        	savecounter(newVal, oldVal) {
        		this.saveHints();
        		this.deleteHints();
        	}
        },

        computed: {
        },

        methods: {
        	getHints() {
        		axios.get('/api/question/' + this.initquestion.id + '/hint')
        			.then(response => {
        				this.hints = response.data;
        			})
        	},

        	addHint() {
        		axios.post('/api/question/' + this.initquestion.id + '/hint/store', {
	        			'hint': ''
	        		})
        			.then(response => {
        				console.log(response.data);
        				this.hints.push(response.data);
                        this.$emit('updatehints');
                    });
            },

            removeHint(hint) {
                console.log(hint);
                this.hintsToDelete.push(hint);
                this.hints.splice(this.hints.indexOf(hint), 1);
            },

            saveHints() {
                if(this.hints.length){
                    console.log('saving');
                    console.log(this.hints.length);
                    console.log(this.hints);
                    this.hints.forEach(hint => {
                        axios.post('/api/hint/' + hint.id + '/update', {
                            'hint': hint
                        })
                        .then(response => {
                            this.$emit('updatehints');
                        })
            		})
                }
        	},

        	deleteHints() {
                if(this.hintsToDelete.length){
            		this.hintsToDelete.forEach(hint => {
            			axios.get('/api/hint/' + hint.id + '/destroy')
                        .then(response => {
                            this.$emit('updatehints');
                        })
                    })
                }
        	}
        }
    }
</script>