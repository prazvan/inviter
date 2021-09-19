<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-primary">
            <router-link :to="{ name: 'home' }" class="navbar-brand text-white">inviter.com</router-link>
        </nav>

        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    watch: {
        // $route() {
        //     // $("#navbarCollapse").collapse("hide");
        // },
    },
};
</script>
