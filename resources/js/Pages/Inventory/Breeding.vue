<template>

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
</template>

<script>
    export default {
        name: "Breeding",
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
                    {"data": "litter_no", "title": "Litter No."},
                    {"data": "cage_no", "title": "Cage No."},
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
