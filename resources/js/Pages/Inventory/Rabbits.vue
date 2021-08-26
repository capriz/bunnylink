<template>
    <div>
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Rabbits</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Rabbits Data Table
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <a :href="data.rabbits_form_link" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Add a Rabbit</a>
                                </div>
                                <div class="col-12 mt-3">
                                    <table id="rabbits-table" class="table table-hover nowrap"
                                           style="width: 100%"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Rabbits.vue",
        props: ['data'],
        data() {
            return {dt: null,};
        },
        mounted() {
            let $this = this;
            $this.dt = $('#rabbits-table').DataTable({
                scrollX: true,
                serverSide: true,
                ajax: {
                    url: $this.data.rabbits_table_link,
                    type: 'POST'
                },
                "order": [[0, "desc"]],
                "columns": [
                    {
                        "data": function (value) {
                            let hold = '';
                            hold += "<a href='" + value.rabbits_update_link + "' class='btn btn-link'>" + value.tag_id + "</a>";
                            if (value.avatar) {
                                hold += "<button class='btn btn-sm btn-info btn-img text-white'><i class='fas fa-image'></i></button>";
                            }
                            return hold;
                        }, "name": "tag_id", "title": "ID"
                    },
                    {"data": "cage_no", "title": "Cage No."},
                    {"data": "category", "title": "Category"},
                    {"data": "breed", "title": "Breed"},
                    {"data": "type", "title": "Type"},
                    {"data": "color", "title": "Color"},
                    {"data": "dob", "title": "Date Of Birth"},
                    {"data": "gender", "title": "Gender"},
                    {
                        "data": function (value) {
                            if(!value.rabbit_status.color)
                                value.rabbit_status.color = 'black';
                            return "<label class='fw-bolder' style='color: " + value.rabbit_status.color + "'>" +
                                value.status + "</label>"
                        }, name: "status", "title": "Status"
                    },
                    {
                        "data": function (value) {
                            if (parseInt(value.home_breed))
                                return "Yes";
                            return "No";
                        }, "name": "home_breed", "title": "Home Breed?"
                    },
                    {"data": "litter_no", "title": "Litter ID"},
                    {"data": "created_at", "title": "Created At"},
                    {"data": "notes", "title": "Notes"},
                    {"data": "inserted_by", "title": "Inserted By"},
                    {"data": "updated_by", "title": "Updated By"},
                ],
                drawCallback: function (settings) {
                    $('.btn-img').on('click', function () {
                        let hold = $this.dt.row($(this).parent()).data();
                        alertify.alert("<img src='/" + hold.avatar + "' class='img-fluid' width='800px'>", function () {
                            alertify.message('OK');
                        });
                    });
                }
            });
        }
    }
</script>

<style scoped>

</style>
