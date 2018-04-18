<template>
    <div>
        <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
            <div class="card-body">
                <div class="alert alert-success" v-if="success">
                    <strong>Success!</strong> Task was successfully added.
                </div>
                <div class="alert alert-danger" v-if="failed">
                    <strong>Error!</strong> Task was not created.
                </div>
                <div class="form-group">
                    <input id="task-name"
                           v-model="task.name"
                           type="text"
                           placeholder="task name"
                           required="required"
                           class="form-control">
                    <span v-if="errors.name" class="help-block text-danger"> {{ errors.name[0] }} </span>
                </div>

                <div class="form-group">
                  <textarea id="task-description"
                            v-model="task.description"
                            type="text"
                            placeholder="task description"
                            rows="10"
                            class="form-control">

                        {{ task.description }}
                    </textarea>
                    <span v-if="errors.description" class="help-block text-danger"> {{ errors.description[0] }}</span>
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
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            userId: {
                type: Number,
                required: true
            }
        },

        data() {
            return {
                success: false,
                failed: false,
                endpoint: '/api/tasks/',
                errors: [],
                task: {
                    name: null,
                    description: null,
                    user_id: this.userId
                }
            };
        },

        created() {
            //
        },

        methods: {

            onSubmit(e) {
                axios.post('/api/tasks', this.task)
                    .then(({data}) => this.onRequestSuccess())
                    .catch(({response}) => this.onRequestFailed(response));
            },

            onRequestFailed(response) {
                this.failed = true;
                this.errors = response.data.errors;
            },

            onRequestSuccess() {
                this.success = true;
                this.task.name = '';
                this.task.description = '';
            },
        }
    }
</script>
