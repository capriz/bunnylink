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
                                    <table id="rabbits-table" class="table table-hover nowrap" style="width: 100%"></table>
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
                    {"data": "tag_id", "title": "ID"},
                    {"data": "breeding_id", "title": "Breeding ID"},
                    {"data": "cage_no", "title": "Cage No."},
                    {"data": "category", "title": "Category"},
                    {"data": "breed", "title": "Breed"},
                    {"data": "type", "title": "Type"},
                    {"data": "color", "title": "Color"},
                    {"data": "dob", "title": "Date Of Birth"},
                    {"data": "gender", "title": "Gender"},
                    {"data": "status", "title": "Status"},
                    {"data": "home_breed", "title": "Home Breed?"},
                    {"data": "litter_id", "title": "Litter ID"},
                    {"data": "created_at", "title": "Created At"},
                    {"data": "notes", "title": "Notes"},
                ],
                drawCallback: function (settings) {

                }
            });
        }
    }
</script>

<style scoped>

</style>
