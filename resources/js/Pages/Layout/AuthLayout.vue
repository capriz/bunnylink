<template>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" v-if="links.home" style="text-decoration: unset;" :href="links.home">
                    <span class="align-middle">{{ app_name }}</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Components
                    </li>
                    <li class="sidebar-item" v-if="links.home">
                        <inertia-link class="sidebar-link" :href="links.home">
                            <i class="fas fa-chart-area"> </i> <span class="align-middle">Dashboard</span>
                        </inertia-link>
                    </li>
                    <li class="sidebar-item">
                        <a href="#rabbits" data-bs-toggle="collapse"
                           class="sidebar-link show collapsed" aria-expanded="false"
                        >
                            <i class="fas fa-database"></i><span class="align-middle">Inventory</span>
                        </a>
                        <ul id="rabbits" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item" v-if="links.rabbits">
                                <inertia-link class="sidebar-link" :href="links.rabbits">
                                    Rabbits
                                </inertia-link>
                            </li>
                            <li class="sidebar-item" v-if="links.breeding">
                                <inertia-link class="sidebar-link" :href="links.breeding">
                                    Breeding
                                </inertia-link>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item" v-if="links.options">
                        <inertia-link class="sidebar-link" :href="links.options">
                            <i class="fas fa-cogs"> </i> <span class="align-middle">Options</span>
                        </inertia-link>
                    </li>
                    <li class="sidebar-item">
                        <a href="#manage-users" data-bs-toggle="collapse"
                           class="sidebar-link show collapsed" aria-expanded="false"
                        >
                            <i class="fas fa-users-cog"></i>
                            <span class="align-middle">Manage Users</span>
                        </a>
                        <ul id="manage-users" class="sidebar-dropdown list-unstyled collapse"
                            data-bs-parent="#sidebar">
                            <li class="sidebar-item" v-if="links.roles">
                                <inertia-link class="sidebar-link" :href="links.roles">Roles</inertia-link>
                            </li>
                            <li class="sidebar-item" v-if="links.users">
                                <inertia-link class="sidebar-link" :href="links.users">Users</inertia-link>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="main">

            <TopBar></TopBar>

            <main class="content">
                <slot></slot>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <!--                                <a href="index.html" class="text-muted"><strong>{{ env('APP_NAME') }}</strong></a>-->
                                &copy;
                                <!--                                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})-->
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <!--                                <li class="list-inline-item">-->
                                <!--                                    <a class="text-muted" href="#">Support</a>-->
                                <!--                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
    import {InertiaLink} from "@inertiajs/inertia-vue3"
    import TopBar from "./TopBar";

    export default {
        name: "AuthLayout",
        data() {
            return {
                links: {},
                app_name: '',
            }
        },
        components: {InertiaLink, TopBar},
        methods: {
            fetchDefaults() {
                var $this = this;
                axios.post('/defaults').then(function (value) {
                    $this.links = value.data.links;
                    $this.app_name = value.data.app_name;
                });
            }
        }, mounted() {
            this.fetchDefaults();
        }
    }
</script>

<style scoped>

</style>
