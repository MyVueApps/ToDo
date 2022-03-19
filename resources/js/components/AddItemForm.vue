<template>
    <div class="p-1">
        <input class="mb-2 container-fluid form-control" v-model="taskText" placeholder="ADD NEW TASK">
        <button class="form-control btn btn-success container-fluid" @click.prevent="addTask">Add Task
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                taskText: null,
            }
        },
        methods: {
            addTask() {
                if (this.taskText == null)
                    return;

                axios.post('api/items', {
                    'name': this.taskText,
                }).then(responce => {
                    if (responce.status === 201) {
                        this.taskText = null;
                    }
                    this.$emit('addListEvent');
                }).catch(error => {
                    console.log(error);
                });
            },
        }
    }
</script>

<style scoped>

</style>