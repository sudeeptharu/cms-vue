<script setup>

</script>

<template>
    <router-view></router-view>
</template>

<style scoped>
.el-aside {
    width: auto;
    border-right: solid 1px var(--el-menu-border-color);
    min-height: 100vh;
}

.el-footer {
    bottom: 0;
    width: 100%;
}

.el-main {
    border-top: solid 1px var(--el-menu-border-color);
    padding-left: 1rem;
}

header {
    padding-top: 0.75rem;
    padding-bottom: 4rem;
}

.el-footer {
    padding-left: 0;
    padding-right: 0;
}

.el-header {
    margin-bottom: 0.5em;
    padding-left: 0;
    padding-right: 0;
}
</style>
