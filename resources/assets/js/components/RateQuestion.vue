<template>
	<div class="rate clickable" v-if=" scorecardid > 0 ">
		<span class="star" v-for="n in 5" @click="setWeight(n)"> 
			<i class="material-icons" v-if="scorecard.weight >= n"> star </i>
			<i class="material-icons" v-else> star_border </i>
		</span>
	</div>
</template>

<script>
    export default {
        props: [
        	'question',
        	'scorecardid'
        ],

        data() {
            return {
            	'scorecard': {}
            }
        },

        mounted() {
        	if ( this.scorecardid > 0 ) {
        		this.getScorecard();
        	}
        },

        computed: {
        },

        methods: {
        	getScorecard() {
        		axios.get('/api/scorecard/' + this.scorecardid)
        			.then(response => {
        				this.scorecard = response.data;
        			})
        	},

        	setWeight(n) {
        		this.scorecard.weight = n;
        		this.postScorecard();
        	},

        	postScorecard() {
        		axios.post('/api/scorecard/' + this.scorecardid + '/update', {
        			'scorecard': this.scorecard
        		});
        	},
        }
    }
</script>