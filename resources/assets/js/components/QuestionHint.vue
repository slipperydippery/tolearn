<template>
	<div class="hint--container col-sm-4" @click="toggleReveal()">
		<div class="hint__reveal">
			<div class="hint__blind d-flex align-items-center" v-if="hidden">
				<h4>Hint {{ index + 1 }}</h4>
			</div>
			<vue-markdown :source="hint.hint" v-if="hint.hint"></vue-markdown>
		</div>
	</div>
</template>

<script>
    import VueMarkdown from 'vue-markdown';

    export default {
        props: [
        	'hint',
        	'index'
        ],

	    components: {
	        VueMarkdown
	    },

        data() {
            return {
            	'hidden': true,
            }
        },

        mounted() {
        },

        computed: {
        },

        methods: {
        	toggleReveal() {
        		this.hidden = ! this.hidden;
        	}
        }
    }
</script>