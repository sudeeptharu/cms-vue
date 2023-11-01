<script setup>

import {ArrowLeft, Bell, FullScreen, Moon, Sunny, User} from "@element-plus/icons-vue";
import {onBeforeMount, ref} from "vue";
import {useThemeSwitchStore} from "../../../stores/modules/themeSwitch.js";
import Login from "../fragments/Login.vue";

const themeSwitchStore = useThemeSwitchStore();
let themeValue = ref('light');
const themePreset = () =>themeValue = ref(themeSwitchStore.theme === 'light')
onBeforeMount(()=>{
    themePreset()
})
const themeSwitch = val => {
    if (val)
    {

        themeSwitchStore.setTheme('light')
        themeValue = ref(true);
        document.documentElement.classList.add('light')
        document.documentElement.classList.remove('dark')
    }
    else
    {
        document.documentElement.classList.add('dark')
        document.documentElement.classList.remove('light')
        themeSwitchStore.setTheme('dark')
        themeValue = ref(false);
    }
}
</script>

<template>
    <div class="common-layout">
        <div class="flex items-center justify-flex-end auth-top-bar">
            <el-dropdown class="header-extra" :hide-on-click="false">
                <span class="el-dropdown-link">
                  <el-button style="padding: 0" size="small" text="plain">
                    ने
                  </el-button>
                </span>
                <template #dropdown>
                    <el-dropdown-menu>
                        <el-dropdown-item>नेपाली</el-dropdown-item>
                        <el-dropdown-item>English</el-dropdown-item>
                    </el-dropdown-menu>
                </template>
            </el-dropdown>
            <el-switch
                v-model=themeValue
                class="mt-2 header-extra"
                style="margin-left: 24px"
                inline-prompt
                :active-icon="Sunny"
                :inactive-icon="Moon"
                @change = themeSwitch
                size="small"
            />
        </div>
        <el-row class="row-bg" justify="center">
            <el-col :span="24" style="text-align: center; margin-bottom: 25px; padding-left:5px; padding-right: 5px">
                <el-image class="auth-logo" src="/images/logo.png" fit="contain" />
                <h5 style="margin-bottom: 0">_____ पालिका</h5>
                <p style="font-size: 12px; margin-bottom: 0">दर्ता चलानी तथा पत्र व्यवस्थापन प्रणाली</p>
            </el-col>
           <Login/>
        </el-row>
    </div>
</template>

<style scoped>

</style>
