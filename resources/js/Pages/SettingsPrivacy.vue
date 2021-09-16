<template>
    <auth-layout>
        <div>
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Settings</h1>

                    <div class="row">
                        <div class="col-md-3 col-xl-2">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Profile Settings</h5>
                                </div>

                                <div class="list-group list-group-flush" role="tablist">
                                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                       href="#account" role="tab">
                                        Account
                                    </a>
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password"
                                       role="tab">
                                        Password
                                    </a>
                                    <!--                                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"-->
                                    <!--                                   role="tab">-->
                                    <!--                                    Privacy and safety-->
                                    <!--                                </a>-->
                                    <!--                                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"-->
                                    <!--                                   role="tab">-->
                                    <!--                                    Email notifications-->
                                    <!--                                </a>-->
                                    <!--                                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"-->
                                    <!--                                   role="tab">-->
                                    <!--                                    Web notifications-->
                                    <!--                                </a>-->
                                    <!--                                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"-->
                                    <!--                                   role="tab">-->
                                    <!--                                    Widgets-->
                                    <!--                                </a>-->
                                    <!--                                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"-->
                                    <!--                                   role="tab">-->
                                    <!--                                    Your data-->
                                    <!--                                </a>-->
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#"
                                       role="tab">
                                        Delete account
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-xl-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="account" role="tabpanel">

                                    <div class="card">
                                        <div class="card-header">

                                            <h5 class="card-title mb-0">Public info</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputUsername">Full Name</label>
                                                            <input type="text" class="form-control" id="inputUsername"
                                                                   placeholder="Username">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <form @submit.prevent="submit" class="text-center">
                                                            <img v-if="!data.profile_pic_link"
                                                                 src="https://avatars.dicebear.com/api/jdenticon/.svg"
                                                                 class="img-responsive mb-4 shadow-sm" width="128"
                                                                 height="128"/>
                                                            <img v-else v-bind:src="data.profile_pic_link"
                                                                 class="img-responsive mb-4 shadow-sm" width="128"
                                                                 height="128"/>
                                                            <input type="file"
                                                                   @input="form.avatar = $event.target.files[0]"/>
                                                            <progress v-if="form.progress" :value="form.progress.percentage"
                                                                      max="100">
                                                                {{ form.progress.percentage }}%
                                                            </progress>
                                                            <button class="btn btn-primary mt-2" type="submit">Submit</button>
                                                            <br>
                                                            <small>For best results, use an image at least 128px by 128px in
                                                                .jpg format</small>
                                                        </form>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="password" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Change Password</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputPasswordCurrent">Current
                                                        password</label>
                                                    <input type="password" class="form-control" id="inputPasswordCurrent">
                                                    <small><a href="#">Forgot your password?</a></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputPasswordNew">New password</label>
                                                    <input type="password" class="form-control" id="inputPasswordNew">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputPasswordNew2">Verify
                                                        password</label>
                                                    <input type="password" class="form-control" id="inputPasswordNew2">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from "./Layout/AuthLayout";
    export default {
        name: "SettingsPrivacy",
        components: {AuthLayout},
        props: {
            data: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    avatar: null,
                }, {
                    resetOnSuccess: false,
                }),
            };
        },
        methods: {
            submit() {
                var $this = this;
                if (this.form.avatar === null || this.form.avatar === undefined) {
                    alertify.error('Please select a file!');
                    return false;
                }
                this.form.post(this.data.upload_photo_link);
            },
        },
    }
</script>

<style scoped>

</style>
