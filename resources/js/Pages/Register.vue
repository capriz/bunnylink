<template>
    <div class="row justify-content-center">
        <div class="col-xs-6 col-8">
            <div class="card">
                <div class="card-body">
                    <form>
                        <h2>Account Credentials</h2>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" v-model="overview.user.email"
                                   v-bind:class="{'is-invalid':errors.hasOwnProperty('user.email')}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input class="form-control" v-model="overview.user.password"
                                   v-bind:class="{'is-invalid':errors.hasOwnProperty('user.password')}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input class="form-control" v-model="overview.user.password_confirmation"
                                   v-bind:class="{'is-invalid':errors.hasOwnProperty('user.password_confirmation')}">
                        </div>
                        <h2>Personal Information</h2>
                        <hr>
                        <div class="d-flex flex-row">
                            <div class="mb-3 flex-grow-1 pe-3">
                                <label class="form-label">Full Name</label>
                                <input class="form-control" v-model="overview.user.name"
                                       v-bind:class="{'is-invalid':errors.hasOwnProperty('user.name')}">
                            </div>
                            <div class="mb-3 flex-grow-1">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" v-model="overview.user.dob"
                                       v-bind:class="{'is-invalid':errors.hasOwnProperty('user.dob')}">
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="mb-3 flex-grow-1 pe-3">
                                <label class="form-label">Primary Phone No.</label>
                                <input class="form-control" v-model="overview.user.phone_primary"
                                       v-bind:class="{'is-invalid':errors.hasOwnProperty('user.phone_primary')}">
                            </div>
                            <div class="mb-3 flex-grow-1">
                                <label class="form-label">Other Phone No.</label>
                                <input class="form-control" v-model="overview.user.phone_other">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input class="form-control" v-model="overview.user.address"
                                   v-bind:class="{'is-invalid':errors.hasOwnProperty('user.address')}">
                        </div>
                        <div class="d-flex flex-row">
                            <div class="mb-3 flex-grow-1 pe-3">
                                <label class="form-label">Zip Code</label>
                                <input class="form-control" v-model="overview.user.zip_code"
                                       v-bind:class="{'is-invalid':errors.hasOwnProperty('user.zip_code')}">
                            </div>
                            <div class="mb-3 flex-grow-1">
                                <label class="form-label">Country</label>
                                <input class="form-control" v-model="overview.user.country"
                                       v-bind:class="{'is-invalid':errors.hasOwnProperty('user.country')}">
                            </div>
                        </div>
                        <h2>Organization Information</h2>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Organization</label>
                            <input class="form-control" v-model="overview.business.name"
                                   v-bind:class="{'is-invalid':errors.hasOwnProperty('business.name')}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Organization Address</label>
                            <input class="form-control" v-model="overview.business.address"
                                   v-bind:class="{'is-invalid':errors.hasOwnProperty('business.address')}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Organization E-mail</label>
                            <input type="email" class="form-control" v-model="overview.business.email">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="yes" v-model="overview.user.toc"
                                       v-bind:class="{'is-invalid':errors.hasOwnProperty('user.toc')}">
                                <label class="form-check-label">
                                    Do you agree on the <a href="#">Terms and Conditions</a>
                                </label>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-primary" @click="store">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Register",
        props: ['data'],
        data() {
            return {
                errors: {},
                overview: {
                    user: {
                        email: '',
                        password: '',
                        password_confirmation: '',
                        name: '',
                        dob: '',
                        phone_primary: '',
                        phone_other: '',
                        address: '',
                        zip_code: '',
                        country: '',
                        toc: ''
                    },
                    business: {
                        name: '',
                        address: '',
                        email: ''
                    }
                }
            }
        },
        methods: {
            store() {
                var $this = this;
                axios.post(this.data.register_store_link, this.overview).then(function () {
                    window.location = '/dashboard';
                }).catch(function (value) {
                    $this.errors = value.response.data.errors;
                    //catchError(value.response.data.errors)
                    alertify.error('Please fill necessary fields.');
                });

            }
        }
    }
</script>

<style scoped>

</style>
