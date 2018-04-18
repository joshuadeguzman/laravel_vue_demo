<template>
    <div>

        <multiselect v-model="value"
                     :options="options"
                     :multiple="true"
                     group-values="tags"
                     group-label="type"
                     :group-select="true"
                     placeholder="Type to search"
                     track-by="name" label="name">
            <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
        </multiselect>
        <pre class="language-json"><code>{{ value }}</code></pre>

    </div>
</template>

<script>
    export default {
        props: {
            taskId: {
                type: Number,
                required: true
            }
        },

        data() {
            return {
                endpoint: '/api/tags',
                options: [
                    {
                        type: 'Top 3 Most Used Tags',
                        tags: [

                        ]
                    }
                ],
                value: []
            }
        },

        created() {
            this.fetchRankedTags();
        },

        methods: {
            fetchRankedTags() {
                axios.get(this.endpoint)
                    .then(({data}) => {
                        this.options[0].tags = data.data;
                    });
            }
        }
    }
</script>
