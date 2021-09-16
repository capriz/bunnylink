<template>
    <auth-layout>
        <div>
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Breeding Form</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Breeding Form
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-lg-1 col-sm-2 mt-3">
                                            <label>Cage No.</label>
                                            <input type="number" v-model="form.cage_no" class="form-control">
                                        </div>
                                        <div class="col-lg-3 col-sm-3 mt-3">
                                            <label>Parent Doe (Dam)</label>
                                            <select class="form-select" v-model="form.parent_doe"
                                                    :class="{ 'is-invalid' : errors.parent_doe}">
                                                <option value="">-- Select Options --</option>
                                                <option v-for="item in data.parent_doe_list" :value="item.id">
                                                    {{ item.tag_id }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 mt-3">
                                            <label>Parent Buck (Sire)</label>
                                            <select class="form-select" v-model="form.parent_buck"
                                                    :class="{ 'is-invalid' : errors.parent_buck}">
                                                <option value="">-- Select Options --</option>
                                                <option v-for="item in data.parent_buck_list" :value="item.id">
                                                    {{ item.tag_id }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Date Bred</label>
                                            <input type="date" v-model="form.date_bred" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Date Expected Kindle</label>
                                            <input type="date" v-model="form.expected_kindle_date" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Date Kindled</label>
                                            <input type="date" v-model="form.kindle_date" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Date Weaning</label>
                                            <input type="date" v-model="form.weaning_date" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Planned Rebreed Date</label>
                                            <input type="date" v-model="form.planned_rebreed_date" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Is Rebreed?</label>
                                            <select v-model="form.isRebreed" class="form-select">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Born Alive</label>
                                            <input type="number" v-model="form.born_alive" class="form-control"
                                                   @keyup="sumTotalKits()">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Born Dead</label>
                                            <input type="number" v-model="form.born_dead" class="form-control"
                                                   @keyup="sumTotalKits()">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Total Kits</label>
                                            <input type="number" v-model="form.total_kits" class="form-control" readonly>
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Born Doe</label>
                                            <input type="number" v-model="form.born_doe" class="form-control">
                                        </div>
                                        <div class="col-lg-2 col-sm-4 mt-3">
                                            <label>Born Buck</label>
                                            <input type="number" v-model="form.born_buck" class="form-control">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label>Notes</label>
                                            <textarea type="number" v-model="form.notes" class="form-control"></textarea>
                                        </div>
                                        <div class="d-grid gap-2 mt-4">
                                            <button class="btn btn-success text-white" type="submit">Submit</button>
                                            <button v-if="data.breeding.length !== 0" @click="deleteConfirm"
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
        name: "BreedingForm",
        components: {AuthLayout},
        props: ['data', 'errors'],
        data() {
            return {
                form: this.$inertia.form({
                    cage_no: 0,
                    parent_doe: '',
                    parent_buck: '',
                    date_bred: '',
                    expected_kindle_date: '',
                    kindle_date: '',
                    weaning_date: '',
                    planned_rebreed_date: '',
                    isRebreed: 0,
                    born_alive: 0,
                    born_dead: 0,
                    total_kits: 0,
                    born_doe: 0,
                    born_buck: 0,
                    notes: '',
                }),
                litter_details: {},
            };
        },
        methods: {
            deleteConfirm() {
                var $this = this;
                alertify.confirm('Confirm', 'Do you want to delete this?', function () {
                    window.location = $this.data.breeding_delete_link;
                }, function () {
                    alertify.error('Cancel')
                });
            },
            submit() {
                this.form.post(this.data.breeding_store_link, {
                    onSuccess: function (value) {
                        console.log(value)
                    },
                })
            },
            sumTotalKits() {
                this.form.total_kits = this.form.born_alive - this.form.born_dead;
            }
        },
        mounted() {
            let $this = this;
            if ($this.data.breeding.length !== 0) {
                $this.form = this.$inertia.form($this.data.breeding);
            }
        }
    }
</script>

<style scoped>

</style>
