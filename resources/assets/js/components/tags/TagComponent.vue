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
                    Save Tags
                </button>
                <a href="/home"
                   class="btn btn-outline-danger btn-sm"
                   id="cancel">
                    Cancel
                </a>
            </div>
        </form>
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
                value: [],
                options: []
            }
        },

        created() {
            this.fetchTaskTags();
            this.fetchRankedTags();
        },

        methods: {
            addTag(newTag) {
                const tag = {
                    id: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000)),
                    name: newTag,
                };
                this.value.push(tag);
            },

            fetchTaskTags() {
                axios.get('/api/tasks/' + this.taskId + '/tags')
                    .then(({data}) => {
                        this.value = data.data;
                    });
            },

            fetchRankedTags() {
                axios.get('/api/tags')
                    .then(({data}) => {
                        this.options = data.data;
                    });
            },

            onSubmit(e) {
                axios.post('/api/tasks/' + this.taskId + '/tags', this.value)
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
