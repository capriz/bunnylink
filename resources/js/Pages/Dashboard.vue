<template>
    <AuthLayout>
        <div>
            <div class="row">
                <div class="col-auto">
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script>
    import TotalDetailChart from "../Charts/TotalDetailChart";
    import AuthLayout from "./Layout/AuthLayout";

    export default {
        props: {
            data: Object,
        },
        components: {
            TotalDetailChart,
            AuthLayout
        },
        mounted() {
        }
    }
</script>
