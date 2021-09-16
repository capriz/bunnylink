<template>
    <auth-layout>
        <div>
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Rabbit Form</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Rabbits Form
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-2 mt-3">
                                            <label>Cage No.</label>
                                            <input type="number" v-model="form.cage_no" class="form-control">
                                        </div>
                                        <div class="col-3 mt-3">
                                            <label>Status</label>
                                            <select v-model="form.status" class="form-select">
                                                <option value="">-- Select Options --</option>
                                                <option v-for="item in data.rabbit_status" :value="item.name">
                                                    {{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-5 mt-3">
                                            <label>Category</label>
                                            <select class="form-select" v-model="form.category">
                                                <option value="">-- Select Options --</option>
                                                <option v-for="item in data.categories" :value="item.name">
                                                    {{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-5 mt-3">
                                            <label>Breed</label>
                                            <select class="form-select" v-model="form.breed">
                                                <option value="">-- Select Options --</option>
                                                <option v-for="item in data.breeds" :value="item.name">
                                                    {{ item.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 mt-3">
                                            <label>Color Of Rabbit</label>
                                            <input type="text" class="form-control" v-model="form.color">
                                        </div>
                                        <div class="col-lg-3 col-md-4 mt-3">
                                            <label>Type</label>
                                            <select class="form-select" v-model="form.type">
                                                <option value="">-- Select Options --</option>
                                                <option value="pet">Pet</option>
                                                <option value="meat">Meat</option>
                                            </select>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <label>Date Of Birth</label>
                                            <input type="date" class="form-control" v-model="form.dob">
                                        </div>
                                        <div class="col-3 mt-3">
                                            <label>Gender</label>
                                            <select class="form-select" v-model="form.gender">
                                                <option value="">-- Select Options --</option>
                                                <option value="doe">Doe</option>
                                                <option value="buck">Buck</option>
                                                <option value="unknown">Unknown</option>
                                            </select>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <label>Home Breed?</label>
                                            <select class="form-select" v-model="form.home_breed">
                                                <option value="">-- Select Options --</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-3 mt-3">
                                            <label>Litter No</label>
                                            <select class="form-select" v-model="form.breeding_id"
                                                    v-on:change="findLitterRel">
                                                <option value="">-- Select Options --</option>
                                                <option v-for="item in data.litters" :value="item.id">
                                                    {{ item.litter_no }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-3 d-flex flex-column mt-4" v-if="litter_details.sire">
                                            <span>Sire: {{ litter_details.sire.tag_id }}</span>
                                            <span>Dam: {{ litter_details.dam.tag_id }}</span>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Notes</label>
                                            <textarea type="text" class="form-control" v-model="form.notes"></textarea>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <label>Image</label>
                                            <input type="file" class="form-control"
                                                   @input="form.photo = $event.target.files[0]"/>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                                {{ form.progress.percentage }}%
                                            </progress>
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-4 mt-2" v-if="form.avatar">
                                            <img :src="'/' + form.avatar" class="rounded img-fluid shadow">
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <button class="btn btn-success text-white" type="submit">Submit</button>
                                            <button v-if="data.rabbit.length !== 0" @click="deleteConfirm"
                                                    class="btn btn-danger text-white"
                                                    type="button">Delete
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from "../Layout/AuthLayout";
    export default {
        name: "RabbitForm",
        components: {AuthLayout},
        props: ['data'],
        data() {
            return {
                form: this.$inertia.form({
                    cage_no: '0',
                    status: '',
                    category: '',
                    breed: '',
                    color: '',
                    type: '',
                    dob: '',
                    gender: '',
                    home_breed: '',
                    breeding_id: '',
                    notes: '',
                    avatar: null,
                    photo: null,
                }),
                litter_details: {},
            };
        },
        methods: {
            deleteConfirm() {
                let $this = this;
                alertify.confirm('Confirm Title', 'Do you want to delete this?', function () {
                    window.location = $this.data.rabbit_delete_link;
                    }, function () {
                        alertify.error('Cancel')
                    });
            },
            submit() {
                this.form.post(this.data.rabbit_store_link, {
                    onSuccess: function (value) {
                        console.log(value)
                    },
                })
            },
            findLitterRel() {
                var $this = this;
                axios.post(this.data.litter_find_link, this.form).then(function (value) {
                    $this.litter_details = value.data;
                });
            }
        },
        mounted() {
            var $this = this;
            if ($this.data.rabbit.length !== 0) {
                $this.form = this.$inertia.form($this.data.rabbit);
                $this.findLitterRel();
            }
        }
    }
</script>

<style scoped>

</style>
