<template>
    <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
        <side-bar
            :background-color="sidebarBackground"
            short-title="Argon"
            title="Argon"
        >
            <template slot="links">
                <sidebar-item
                    :link="{
                        name: 'Dashboard',
                        icon: 'ni ni-tv-2 text-default',
                        path: '/dashboard'
                    }"
                />

                <sidebar-item
                    v-if="isUser"
                    :link="{
                        name: 'Donate',
                        icon: 'ni ni-shop text-default',
                        path: '/donate'
                    }"
                />

                <sidebar-item
                    v-if="!isUser"
                    :link="{
                        name: 'Redeem',
                        icon: 'ni ni-shop text-default',
                        path: '/donate'
                    }"
                />
            </template>
        </side-bar>
        <div class="main-content" :data="sidebarBackground">
            <dashboard-navbar></dashboard-navbar>

            <div @click="toggleSidebar">
                <fade-transition
                    :duration="200"
                    origin="center top"
                    mode="out-in"
                >
                    <!-- your content here -->
                    <router-view></router-view>
                </fade-transition>
                <content-footer v-if="!$route.meta.hideFooter"></content-footer>
            </div>
        </div>
    </div>
</template>
<script>
import DashboardNavbar from "./DashboardNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import { FadeTransition } from "vue2-transitions";

export default {
    components: {
        DashboardNavbar,
        ContentFooter,
        FadeTransition
    },
    data() {
        return {
            sidebarBackground: "vue" //vue|blue|orange|green|red|primary
        };
    },
    computed: {
        isUser() {
            return localStorage.getItem("role") === "user";
        }
    },
    methods: {
        toggleSidebar() {
            if (this.$sidebar.showSidebar) {
                this.$sidebar.displaySidebar(false);
            }
        }
    }
};
</script>
<style lang="scss"></style>
