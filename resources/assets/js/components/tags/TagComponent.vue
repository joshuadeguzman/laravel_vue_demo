<template>
    <div>
        <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
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
            //
        },

        created() {
            //
        },

        methods: {
            //
        }
    }
</script>
