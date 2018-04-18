<template>
    <div>
        <div v-for="task in tasks"
             class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        {{ task.name }}
                    </div>

                    <div class="card-body">
                        {{ task.description }}
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
                        console.log(this.tasks);
                    });
            }
        }
    }
</script>
