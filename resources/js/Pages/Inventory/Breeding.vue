<template>
    <auth-layout>
        <div>
            <div class="container-fluid p-0">
                <h1 class="h3 mb-3">Breeding</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Breeding Data Table
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto mt-2">
                                        <a :href="data.breeding_form_link" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Add a Breeding
                                        </a>
                                    </div>
                                    <div class="col-auto mt-3 d-flex flex-row my-auto">
                                        <span>Legends:</span>
                                        <span class="mx-2">
                                        <i class="fas fa-square" style="color: green"></i> Pregnant
                                    </span>
                                        <span class="mx-2">
                                        <i class="fas fa-square" style="color: #ff646c"></i> Due Date
                                    </span>
                                        <span class="mx-2">
                                        <i class="fas fa-square" style="color: dodgerblue"></i> For Weaning
                                    </span>
                                        <span class="mx-2">
                                        <i class="fas fa-square" style="color: sandybrown"></i> For Rebreeding
                                    </span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <table id="breeding-table" class="table table-hover nowrap"
                                               style="width: 100%"></table>
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
    import AuthLayout from "../Layout/AuthLayout";
    export default {
        name: "Breeding",
        components: {AuthLayout},
        props: ['data'],
        data() {
            return {dt: null,};
        },
        mounted() {
            let $this = this;
            $this.dt = $('#breeding-table').DataTable({
                scrollX: true,
                serverSide: true,
                ajax: {
                    url: $this.data.breeding_table_link,
                    type: 'POST'
                },
                "order": [[0, "desc"]],
                "columns": [
                    {
                        "data": function (value) {
                            let hold = '';
                            hold += "<a href='" + value.breeding_edit_link + "' class='btn btn-link'>" + value.litter_no + "</a>";
                            if (value.date_bred) {
                                hold += '<i class="fas fa-square" style="color: green"></i>';
                            }
                            if (!value.is_due_date) {
                                hold += '<i class="fas fa-square" style="color: #ff646c"></i>';
                            }
                            if (!value.is_weaning) {
                                hold += '<i class="fas fa-square" style="color: dodgerblue"></i>';
                            }
                            if(!value.is_rebreeding) {
                                hold += '<i class="fas fa-square" style="color: sandybrown"></i>';
                            }

                            return hold;
                        }, "name": "litter_no", "title": "Litter No."
                    },
                    {"data": "cage_no", "title": "Cage No."},
                    {"data": "sire.tag_id", "title": "Sire"},
                    {"data": "dam.tag_id", "title": "Dam"},
                    {"data": "date_bred", "title": "Date Bred"},
                    {"data": "expected_kindle_date", "title": "Expected Kindle Date"},
                    {"data": "kindle_date", "title": "Kindle Date"},
                    {"data": "weaning_date", "title": "Weaning Date"},
                    {"data": "planned_rebreed_date", "title": "Planned Rebreed Date"},
                    {"data": "isRebreed", "title": "Is Rebreed?"},
                    {"data": "born_alive", "title": "Born Alive"},
                    {"data": "born_dead", "title": "Born Dead"},
                    {"data": "total_kits", "title": "Total Kits"},
                    {"data": "born_doe", "title": "Born Does"},
                    {"data": "born_buck", "title": "Born Buck"},
                    {"data": "created_at", "title": "Created At"},
                    {"data": "notes", "title": "Notes"},
                    {"data": "inserted_by", "title": "Inserted By"},
                    {"data": "updated_by", "title": "Updated By"},
                ],
                drawCallback: function (settings) {

                }
            });
        }
    }
</script>

<style scoped>

</style>
