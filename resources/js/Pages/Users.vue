<template>
    <auth-layout>
        <div>
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Users</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Users Data Table
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" @click="showAddUser">Add User</button>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <table id="users-table" class="table table-hover" style="width: 100%"></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Edit Modal -->
            <div id="user-edit-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Edit Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input class="form-control" v-model="overview.name">
                                </div>
                                <div class="mb-3">
                                    <label>Roles</label>
                                    <select class="form-select" v-model="overview.role">
                                        <option v-for="item in data.roles" v-bind:value="item.name">
                                            {{ item.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="update">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Add Modal -->
            <div id="user-add-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User Add Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <div class="mb-2">
                                    <label>Name</label>
                                    <input name="name" class="form-control" v-model="overview.name">
                                </div>
                                <div class="mb-2">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" v-model="overview.email">
                                </div>
                                <div class="mb-2">
                                    <label>New Password</label>
                                    <input name="password" type="password" class="form-control"
                                           v-model="overview.password">
                                </div>
                                <div class="mb-2">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" type="password" class="form-control"
                                           v-model="overview.password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="save">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password Modal -->
            <div id="user-cp-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Password Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <div>
                                    <label>New Password</label>
                                    <input type="password" class="form-control" v-model="overview.password">
                                </div>
                                <div>
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control"
                                           v-model="overview.password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="changePassword">Save changes</button>
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
        components: {AuthLayout},
        props: {
            data: Object,
        },
        data() {
            return {
                overview: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                dt: null,
                user_edit_modal: null,
                user_add_modal: null,
                user_cp_modal: null,
            };
        },
        methods: {
            showAddUser() {
                this.user_add_modal.show();
                this.overview = {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                };
            },
            changePassword() {
                var $this = this;
                $this.user_cp_modal.hide();
                axios.post($this.data.users_cp_link, $this.overview).then(function () {
                    alertify.success('<label class="text-white">Change Password Success!</label>');
                    $this.dt.draw();
                }).catch(function (error) {
                    catchError(error.response.data.errors);
                });
            },
            update() {
                var $this = this;
                $this.user_edit_modal.hide();
                axios.post($this.data.users_update_link, $this.overview).then(function () {
                    $this.dt.draw();
                    alertify.success('<label class="text-white">Update Success!</label>');
                }).catch(function (error) {
                    catchError(error.response.data.errors);
                });
            },
            save() {
                var $this = this;
                $this.user_add_modal.hide();
                axios.post($this.data.users_store_link, $this.overview).then(function () {
                    $this.dt.draw();
                    alertify.success('<label class="text-white">Insert Success!</label>');
                }).catch(function (error) {
                    catchError(error.response.data.errors);
                });
            },
            showDestroy() {
                var $this = this;
                alertify.confirm('Delete User', "Are you sure you want to delete this user?",
                    function () {
                        axios.post($this.data.users_del_link, $this.overview).then(function () {
                            $this.dt.draw();
                            alertify.success('<label class="text-white">Delete Success!</label>');
                        })
                    },
                    function () {
                        alertify.error('Cancel');
                    });
            }
        },
        mounted() {
            var $this = this;

            $this.user_add_modal = new bootstrap.Modal(document.getElementById('user-add-modal'), {
                keyboard: false
            });

            $this.user_edit_modal = new bootstrap.Modal(document.getElementById('user-edit-modal'), {
                keyboard: false
            });

            $this.user_cp_modal = new bootstrap.Modal(document.getElementById('user-cp-modal'), {
                keyboard: false
            });

            $this.dt = $('#users-table').DataTable({
                serverSide: true,
                ajax: {
                    url: $this.data.users_table_link,
                    type: 'POST'
                },
                "order": [[0, "desc"]],
                "columns": [
                    {
                        "data": function (value) {
                            return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">\n' +
                                '  <button type="button" class="btn btn-edit btn-primary"><i class="fas fa-pencil-alt"></i></button>\n' +
                                '  <button type="button" class="btn btn-cp btn-warning text-white"><i class="fas fa-key"></i></button>\n' +
                                '  <button type="button" class="btn btn-destroy btn-danger text-white"><i class="fas fa-trash"></i></button>\n' +
                                '</div>'
                        }, "name": "id", "title": "ID"
                    },
                    {
                        "data": function (value) {
                            return '<div class="d-flex justify-content-between">' +
                                '<span>' + value.name + '</span>' +
                                '<div><span class="badge bg-primary">' + value.role + '</span></div>' +
                                '</div>';
                        }, "title": "Name"
                    },
                    {"data": "email", "title": "E-mail"},
                    {"data": "created_at", "title": "Created At"},
                    {"data": "updated_at", "title": "Created At"},
                ],
                drawCallback: function (settings) {
                    $('.btn-edit').on('click', function () {
                        $this.user_edit_modal.show();
                        $this.overview = $this.dt.row($(this).parent().parent()).data();
                    });

                    $('.btn-cp').on('click', function () {
                        $this.user_cp_modal.show();
                        $this.overview = $this.dt.row($(this).parent().parent()).data();
                    });

                    $('.btn-destroy').on('click', function () {
                        $this.overview = $this.dt.row($(this).parent().parent()).data();
                        $this.showDestroy();
                    })
                }
            });
        }
    }
</script>
