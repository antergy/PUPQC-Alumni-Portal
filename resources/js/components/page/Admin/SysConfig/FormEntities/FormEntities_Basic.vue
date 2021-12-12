<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">Form Entities (Basic Components)</p>
            <div class="separator"></div>
            <!-- Tabs -->
            <ul id="tabs" class="inline-flex w-full mt-4 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                    <a id="default-tab" href="#first">Form General Setup</a>
                </li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#second">Form Question Type Setup</a>
                </li>
            </ul>
            <!-- Tab Contents -->
            <div id="tab-contents" class="bg-white w-fullx">
                <div id="first" class="p-4">
                    <FE_Basic_General />
                </div>
                <div id="second" class="hidden p-4">
                    <FE_Basic_Types />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FE_Basic_General from "./FE_Basic_General";
import FE_Basic_Types from "./FE_Basic_Types";
import FormEntitiesFunctions from "../../../../../plugins/Modular/FormEntities/FormEntitiesFunctions";
export default {
    mixins: [
        FormEntitiesFunctions
    ],
    components: {
        FE_Basic_General,
        FE_Basic_Types,
    },
    created() {
        this.$root.setUserInfo();
    }
}
</script>

<style scoped>
@import '../SysConfig.css';
</style>
