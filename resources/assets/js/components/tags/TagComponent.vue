<template>
    <div>
        <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
            <div class="alert alert-success" v-if="success">
                <strong>Success!</strong> Tags has been successfully set.
            </div>

            <div class="alert alert-danger" v-if="failed">
                <strong>Error!</strong> Tags was not set.
            </div>
            <div class="form-group">
                <multiselect v-model="value"
                             tag-placeholder="Add this as new tag"
                             placeholder="Search or add a tag"
                             label="name" track-by="id"
                             :options="options"
                             :multiple="true"
                             :taggable="true"
                             @tag="addTag">
                </multiselect>
            </div>
            <div class="form-group text-center">
                <button type="submit"
                        class="btn btn-info btn-sm"
                        id="save-task">
                    Save
                </button>
                <a href="/home"
                   class="btn btn-outline-danger btn-sm"
                   id="cancel">
                    Cancel
                </a>
            </div>
        </form>
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
                success: false,
                failed: false,
                endpoint: '/api/tags',
                value: [],
                options: []
            }
        },

        created() {
            this.fetchRankedTags();
        },

        methods: {
            addTag (newTag) {
                const tag = {
                    id: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000)),
                    name: newTag,
                };
                this.value.push(tag);
            },

            fetchRankedTags() {
                axios.get(this.endpoint)
                    .then(({data}) => {
                        this.options = data.data;

                    });
            },

            onSubmit(e) {
                axios.post('/api/tasks/'+ this.taskId + '/tags', this.value)
                    .then(({data}) => this.onRequestSuccess())
                    .catch(({response}) => this.onRequestFailed(response));
            },

            onRequestFailed(response) {
                this.failed = true;
                this.success = false;
                this.errors = response.data.errors;
                console.log(response.data);
            },

            onRequestSuccess() {
                this.success = true;
                this.failed = false;
            },
        }
    }
</script>
