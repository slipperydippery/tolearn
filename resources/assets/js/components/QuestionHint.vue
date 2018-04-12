<template>
	<div class="hint--container col-sm-4" @click="toggleReveal()">
		<div class="hint__reveal">
			<div class="hint__blind d-flex align-items-center" v-if="hidden">
				<h4>Hint {{ index + 1 }}</h4>
			</div>
			{{ hint.hint }}
		</div>
	</div>
</template>

<script>
    export default {
        props: [
        	'hint',
        	'index'
        ],

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