<template>
    <base-nav
        class="navbar-top navbar-dark"
        id="navbar-main"
        :show-toggle-button="false"
        expand
    >
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <base-dropdown class="nav-link pr-0">
                    <div class="media align-items-center" slot="title">
                        <span class="avatar avatar-sm rounded-circle">
                            <img
                                alt="Image placeholder"
                                src="https://i.pravatar.cc/150"
                            />
                        </span>
                    </div>

                    <template>
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <span @click="logoutUser" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </span>
                    </template>
                </base-dropdown>
            </li>
        </ul>
    </base-nav>
</template>
<script>
import User from "../api/User";

export default {
    data() {
        return {
            activeNotifications: false,
            showMenu: false,
            searchQuery: "",
            user: null
        };
    },
    methods: {
        toggleSidebar() {
            this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
        },
        hideSidebar() {
            this.$sidebar.displaySidebar(false);
        },
        toggleMenu() {
            this.showMenu = !this.showMenu;
        },
        logoutUser() {
            User.logout();
            localStorage.removeItem("token");
            this.$router.push({ name: "login" });
        }
    },
    created() {
        User.auth().then(response => {
            this.user = response.data;
            localStorage.setItem("role",this.user.role);
        });
    }
};
</script>
