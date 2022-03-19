<template>
    <div class="card">
        <div class="card-body ">
            <ul class="list-group">
                <li class="list-group-item">
                    <div v-bind:class="{complete:this.task.completed}">{{this.task.name}}</div>
                    <div class="icons">
                        <i class="fa fa-check" @click="completeToggle(task)"></i>
                        <i class="fa fa-trash ml-3" @click="deleteTask(task)"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['task'],
        methods: {
            completeToggle(task) {
                axios.put('api/items/change-status', {
                    'id': task.id
                }).then(response => {
                    console.log(response);
                }).catch(error => {
                    console.log(error);
                });
                this.$emit('completeToggleEvent');
            }, deleteTask(task) {
                axios.delete('api/items/' + task.id).then(response => {
                    console.log(response);
                }).catch(error => {
                    console.log(error);
                });
                this.$emit('deleteItemEvent');
            }
        }
    }
</script>

<style scoped>
    .complete {
        color: green;
        text-decoration: line-through;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
    }
</style>