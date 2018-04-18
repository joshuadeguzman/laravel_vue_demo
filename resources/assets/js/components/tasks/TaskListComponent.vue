<template>
    <div>
        <div class="alert alert-success" v-if="deleted">
            <strong>Success!</strong> Task has been successfully deleted.
        </div>
        <div v-for="task in tasks"
             class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        {{ task.name }}
                        <div class="btn-group float-right">
                            <a :href="'tasks/edit/' + task.id"
                               class="btn btn-secondary btn-sm"
                               id="edit-task">
                                Edit
                            </a>
                            <a href="#"
                               class="btn btn-danger btn-sm"
                               @click="deleteTask(task.id)"
                               id="delete-task">
                                Delete
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ task.description }}
                    </div>

                    <div class="card-footer">
                        <!-- TODO: When click show all tags insights if necessary or filter tasks with the selected tag -->
                        <a href="#"
                           class="btn btn-sm btn-outline-info"
                           style="margin-right: 5px;"
                           v-for="tag in task.tags">
                            {{ tag.name }}
                        </a>
                    </div>
                </div>

                <br/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                deleted: false,
                tasks: [],
                endpoint: '/api/tasks/'
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get(this.endpoint)
                    .then(({data}) => {
                        this.tasks = data.data;
                    });
            },

            deleteTask(id) {
                if (confirm('Are you sure you want to delete this task?')) {
                    axios.delete('/api/tasks/' + id + '')
                        .then(response => this.removeTask(id));
                }
            },

            removeTask(id) {
                this.deleted = true;
                this.tasks = _.remove(this.tasks, function (task) {
                    return task.id !== id;
                });
            }
        }
    }
</script>
