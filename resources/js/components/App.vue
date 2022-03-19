<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tasks Management</div>
                    <div v-for="(task,index) in tasks" :key="index">
                        <list-view v-bind:task="task" v-on:completeToggleEvent="getList()"
                                   v-on:deleteItemEvent="getList()"/>
                    </div>
                    <add-item-form v-on:addListEvent="getList()"/>

                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import AddItemForm from './AddItemForm'
    import ListView from './ListView'
    import axios from 'axios'

    export default {
        data() {
            return {
                tasks: null,
            }
        }, components: {
            AddItemForm,
            ListView,
        },
        methods: {
            allTasks() {
                axios.get('api/items').then(response => {
                    this.tasks = response.data.data.data;
                });
            },
            getList() {
                return this.allTasks();
            }

        },
        created() {
            this.allTasks();
        }
    }
</script>
<style scoped>
    .list-group-item {
        display: flex;
        justify-content: space-between;
    }
</style>