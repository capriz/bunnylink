<template>
    <div>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Roles and Abilities</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Roles Data Table
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <button class="btn btn-primary" @click="showAddModal()">Add a Role</button>
                                </div>
                                <div class="col-12 mb-3">
                                    <table id="roles-table" class="table table-hover" style="width: 100%"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Add Modal -->
        <div id="role-add-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column">
                            <label>Role Name</label>
                            <input type="text" class="form-control" v-model="role_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success text-white" @click="saveRole">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Edit Modal -->
        <div id="role-edit-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-column">
                            <label>Role Name</label>
                            <input type="text" class="form-control" v-model="overview.name">
                        </div>
                        <h5 class="my-2">Manage Users</h5>
                        <div class="d-flex flex-fill">
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" value="manage-users" v-model="overview.abilities">
                                <label class="form-check-label">manage-users</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" value="users" v-model="overview.abilities">
                                <label class="form-check-label">users</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input" type="checkbox" value="roles" v-model="overview.abilities">
                                <label class="form-check-label">roles</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger text-white" @click="deleteRole">Delete</button>
                        <button type="button" class="btn btn-info text-white" @click="editRole">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data: Object,
        },
        data() {
            return {
                role_edit_modal: null,
                role_add_modal: null,
                role_name: '',
                myToast: null,
                overview: {},
            }
        },
        methods: {
            showAddModal() {
                this.role_add_modal.show();
                this.role_name = '';
            },
            saveRole() {
                var $this = this;
                $this.role_add_modal.hide();
                axios.post(this.$props.data.roles_store_link, {role_name: this.role_name})
                    .then(function (value) {
                        alertify.success('<label class="text-white">Success!</label>');
                        $this.dt.draw();
                    })
                    .catch(function (error) {
                        console.log(error.response.data.errors);
                        var errors = error.response.data.errors;
                        var message = '';
                        $.each(errors, function (index, item) {
                            $.each(item, function (index, item) {
                                message += item + '\n';
                            })
                        });
                        alertify.alert(message, function () {
                            alertify.message('OK');
                        });
                    });
            },
            editRole() {
                var $this = this;
                $this.role_add_modal.hide();
                axios.post(this.$props.data.roles_update_link, this.overview)
                    .then(function (value) {
                        alertify.success('<label class="text-white">Success!</label>');
                        $this.dt.draw();
                    })
                    .catch(function (error) {
                        console.log(error.response.data.errors);
                        var errors = error.response.data.errors;
                        var message = '';
                        $.each(errors, function (index, item) {
                            $.each(item, function (index, item) {
                                message += item + '\n';
                            })
                        });
                        alertify.alert(message, function () {
                            alertify.message('OK');
                        });
                    });
            },
            deleteRole() {
                var $this = this;
                $this.role_edit_modal.hide();
                axios.post(this.$props.data.roles_delete_link, this.overview)
                    .then(function (value) {
                        alertify.success('<label class="text-white">Success!</label>');
                        $this.dt.draw();
                    })
                    .catch(function (error) {
                        console.log(error.response.data.errors);
                        var errors = error.response.data.errors;
                        var message = '';
                        $.each(errors, function (index, item) {
                            $.each(item, function (index, item) {
                                message += item + '\n';
                            })
                        });
                        alertify.alert(message, function () {
                            alertify.message('OK');
                        });
                    });
            }
        },
        mounted() {
            var $this = this;

            this.role_add_modal = new bootstrap.Modal(document.getElementById('role-add-modal'), {
                keyboard: false
            });

            this.role_edit_modal = new bootstrap.Modal(document.getElementById('role-edit-modal'), {
                keyboard: false
            });

            this.dt = $('#roles-table').DataTable({
                serverSide: true,
                ajax: {
                    url: $this.data.roles_table_link,
                    type: 'POST'
                },
                "order": [[ 0, "desc" ]],
                "columns": [
                    {"data": "id", "title": "ID"},
                    {
                        "data": function (value) {
                            return "<button class='btn btn-link'>" + value.name + "</button>";
                        }, "title": "Name"
                    },
                    {"data": "created_at", "title": "Created At"},
                    {"data": "updated_at", "title": "Created At"},
                ],
                drawCallback: function (settings) {
                    $('#roles-table tr button').on('click', function () {
                        $this.overview = $this.dt.row($(this).parent().parent()).data();
                        $this.role_edit_modal.show();
                    });
                }
            });
        }
    }
</script>
