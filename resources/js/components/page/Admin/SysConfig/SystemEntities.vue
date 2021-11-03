<template>
    <div class="sysconfig">
        <div class="w-full mx-auto mt-4 ml-20 rounded">
            <p class="text-2xl">System Entities Management</p>
            <div class="separator"></div>
            <!-- Tabs -->
            <ul id="tabs" class="inline-flex w-full mt-4 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                    <a id="default-tab" href="#first">Branch Management</a>
                </li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#second">Course / Program Management</a>
                </li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#third">Degree Management</a>
                </li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#fourth">Post Type Management</a>
                </li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#fifth">Industry Management</a>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div id="tab-contents" class="bg-white w-fullx">
                <div id="first" class="p-4">
                    <Manage_Branches />
                </div>
                <div id="second" class="hidden p-4">
                    <Manage_Courses />
                </div>
                <div id="third" class="hidden p-4">
                    <Manage_Degree />
                </div>
                <div id="fourth" class="hidden p-4">
                    <Manage_PostTypes />
                </div>
                <div id="fifth" class="hidden p-4">
                    <Manage_Industry />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Branches from "./SystemEntities/Manage_Branches";
import Manage_Courses from "./SystemEntities/Manage_Courses";
import Manage_Degree from "./SystemEntities/Manage_Degree";
import Manage_PostTypes from "./SystemEntities/Manage_PostTypes";
import Manage_Industry from "./SystemEntities/Manage_Industry";
export default {
    components: {
        Manage_Branches,
        Manage_Courses,
        Manage_Degree,
        Manage_PostTypes,
        Manage_Industry,
    },
    data() {
        return {

        };
    },
    created() {
        this.$root.setUserInfo();
    },
    mounted() {
        this.initTabs();
    },
    methods: {

        /**
         * Initialize tabs
         */
        initTabs: function () {
            let tabsContainer = document.querySelector("#tabs");
            let tabTogglers = tabsContainer.querySelectorAll("a");
            tabTogglers.forEach(function (toggler) {
                toggler.addEventListener("click", function (e) {
                    e.preventDefault();
                    let tabName = this.getAttribute("href");
                    let tabContents = document.querySelector("#tab-contents");
                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b", "-mb-px", "opacity-100");
                        tabContents.children[i].classList.remove("hidden");
                        if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                        }
                        tabContents.children[i].classList.add("hidden");
                    }
                    e.target.parentElement.classList.add("bg-white", "border-blue-400", "border-b-4", "-mb-px", "opacity-100");
                });
            });
            document.getElementById("default-tab").click();
        },
    }
}
</script>

<style scoped>
@import './SysConfig.css';
</style>
