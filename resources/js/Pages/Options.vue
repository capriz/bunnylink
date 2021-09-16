<template>
    <auth-layout>
        <div>
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Options</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Options
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="d-flex flex-column">
                                            <h3 class="mb-0">Breeds</h3>
                                            <div class="my-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                           aria-describedby="button-addon2" v-model="input_breed">
                                                    <button class="btn btn-success text-white" type="button"
                                                            @click="addBreed">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between "
                                                    v-for="item in breeds">
                                                    {{ item.name }}
                                                    <button type="button" class="btn btn-sm btn-danger text-white"
                                                            @click="removeBreed(item.id)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </li>
                                                <li class="list-group-item" v-if="!breeds.length">No Data Found</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex flex-column">
                                            <h3 class="mb-0">Rabbit Statuses</h3>
                                            <div class="my-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                           aria-describedby="button-addon2"
                                                           placeholder="Type in desired status..."
                                                           v-model="input_rabbit_status.name">

                                                    <input type="text" class="form-control"
                                                           aria-describedby="button-addon2"
                                                           placeholder="Type in Hex Color..."
                                                           v-model="input_rabbit_status.color">
                                                    <span class="input-group-text"
                                                          v-bind:style="'background-color:' + input_rabbit_status.color">color</span>
                                                    <button class="btn btn-success text-white" type="button"
                                                            @click="addRabbitStatus">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between "
                                                    v-for="item in rabbit_statuses"
                                                    v-bind:style="'background-color:' + item.color">
                                                    {{ item.name }}
                                                    <button type="button" class="btn btn-sm btn-danger text-white"
                                                            @click="removeRabbitStatus(item.id)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </li>
                                                <li class="list-group-item" v-if="!rabbit_statuses.length">No Data Found
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex flex-column">
                                            <h3 class="mb-0">Categories</h3>
                                            <div class="my-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                           aria-describedby="button-addon2" v-model="input_category">
                                                    <button class="btn btn-success text-white" type="button"
                                                            @click="addCategory">
                                                        <i class="fas fa-plus-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between "
                                                    v-for="item in categories">
                                                    {{ item.name }}
                                                    <button type="button" class="btn btn-sm btn-danger text-white"
                                                            @click="removeCategory(item.id)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </li>
                                                <li class="list-group-item" v-if="!rabbit_statuses.length">No Data Found
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from "./Layout/AuthLayout";

    export default {
        name: "Options",
        components: {AuthLayout},
        props: ['data'],
        data() {
            return {
                input_breed: '',
                input_category: '',
                breeds: {},
                input_rabbit_status: {
                    name: '',
                    color: '#fff',
                },
                rabbit_statuses: {},
                categories: {}
            }
        },
        methods: {
            getRabbitStatuses() {
                var $this = this;
                axios.post(this.data.rabbit_statuses_get_link, {})
                    .then(function (value) {
                        $this.rabbit_statuses = value.data
                    });
            },
            addRabbitStatus() {
                var $this = this;
                axios.post(this.data.rabbit_statuses_add_link, this.input_rabbit_status)
                    .then(function (value) {
                        $this.getRabbitStatuses();
                        $this.input_rabbit_status = {
                            name: '',
                            color: '#fff',
                        }
                    });
            },
            removeRabbitStatus(id) {
                var $this = this;
                axios.post(this.data.rabbit_statuses_remove_link, {'id': id})
                    .then(function (value) {
                        $this.getRabbitStatuses();
                    });
            },
            getBreeds() {
                var $this = this;
                axios.post(this.data.breeds_get_link, {})
                    .then(function (value) {
                        $this.breeds = value.data
                    });
            },
            addBreed() {
                var $this = this;
                axios.post(this.data.breed_add_link, {'breed': $this.input_breed})
                    .then(function (value) {
                        $this.getBreeds();
                        $this.input_breed = '';
                    });
            },
            removeBreed(id) {
                var $this = this;
                axios.post(this.data.breed_remove_link, {'id': id})
                    .then(function (value) {
                        $this.getBreeds();
                        $this.input_breed = '';
                    });
            },
            getCategories() {
                var $this = this;
                axios.post(this.data.category_link)
                    .then(function (value) {
                        $this.categories = value.data;
                    });
            },
            addCategory() {
                var $this = this;
                axios.post(this.data.category_add_link, {'category': $this.input_category})
                    .then(function (value) {
                        $this.getCategories();
                        $this.input_category = '';
                    });
            },
            removeCategory(id) {
                var $this = this;
                axios.post(this.data.category_remove_link, {'id': id})
                    .then(function (value) {
                        $this.getCategories();
                        $this.input_category = '';
                    });
            }
        },
        mounted() {
            this.getBreeds();
            this.getRabbitStatuses();
            this.getCategories();
        }
    }
</script>

<style scoped>

</style>
