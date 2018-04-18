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
                            {name: 'Vue.js', category: 'Front-end'},
                            {name: 'Adonis', category: 'Backend'}
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
            fetchRankedTags(){
                axios.get(this.endpoint + this.taskId, this.task)
                    .then(({data}) => {
                        this.task = {
                            name: data.name,
                            description: data.description
                        }
                    });
            }
        }
    }
</script>
