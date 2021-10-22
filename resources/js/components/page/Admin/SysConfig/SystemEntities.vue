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
                    <table id="tbl_course_list" class="cell-border m-2">
                        <thead>
                        <tr>
                            <th>Course / Program Acronym</th>
                            <th>Course / Program Desc</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div id="third" class="hidden p-4">
                    Third tab
                </div>
                <div id="fourth" class="hidden p-4">
                    Fourth tab
                </div>
                <div id="fifth" class="hidden p-4">
                    Fourth tab
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Branches from "./SystemEntities/Manage_Branches";
export default {
    components: {
        Manage_Branches
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
