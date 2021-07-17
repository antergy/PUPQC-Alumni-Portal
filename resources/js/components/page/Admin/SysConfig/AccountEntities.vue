<template>
  <div class="sysconfig">

      <div class="w-full mx-auto mt-4 ml-20 rounded">
          <p class="text-2xl">Account Entities Management</p>
          <div class="separator"></div>
          <!-- Tabs -->
          <ul id="tabs" class="inline-flex w-full mt-4 ">
              <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50"><a id="default-tab" href="#first">Accounts List</a></li>
              <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#second">Create an account</a></li>
              <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#third">Electronics</a></li>
              <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#fourth">Others</a></li>
          </ul>

          <!-- Tab Contents -->
          <div id="tab-contents" class="bg-white w-full">
              <div id="first" class="p-4">
                  <div class="form outline">
                      <span class="form__title">Title Here</span>
                      <div class="form__input-group">
                          <label class="form__label">Default</label>
                          <input type="text" class="form__input">
                      </div>

                      <div class="form__input-group sm">
                          <label class="form__label">Small</label>
                          <input type="text" class="form__input">
                      </div>

                      <div class="form__input-group md">
                          <label class="form__label">Medium</label>
                          <input type="text" class="form__input">
                      </div>

                      <div class="form__input-group lg">
                          <label class="form__label">Large</label>
                          <input type="text" class="form__input">
                      </div>

                      <div class="form__input-group lg">
                          <label class="form__label">Textbox</label>
                          <textarea type="text" class="form__textarea" />
                      </div>

                      <div class="form__group row">
                          <div class="form__input-group">
                              <label class="form__label">Here</label>
                              <input type="text" class="form__input">
                          </div>

                          <div class="form__input-group">
                              <label class="form__label">Here</label>
                              <input type="text" class="form__input">
                          </div>
                      </div>

                      <div class="form__input-group">
                          <button type="button" class="form__button">DEFAULT</button>
                          <button type="button" class="form__button success">SAVE</button>
                          <button type="button" class="form__button danger">DELETE</button>
                          <button type="button" class="form__button warning">WARNING</button>
                          <button type="button" class="form__button info">INFO</button>
                      </div>

                  </div>
              </div>
              <div id="second" class="hidden p-4">
                  Second tab
              </div>
              <div id="third" class="hidden p-4">
                  Third tab
              </div>
              <div id="fourth" class="hidden p-4">
                  Fourth tab
              </div>
          </div>
      </div>

  </div>
</template>

<script>
export default {
    data() {
        return {

        };
    },
    mounted() {
        this.initTabs();
    },
    methods: {
        initTabs: function () {
            let tabsContainer = document.querySelector("#tabs");
            let tabTogglers = tabsContainer.querySelectorAll("a");
            console.log(tabTogglers);
            tabTogglers.forEach(function(toggler) {
                toggler.addEventListener("click", function(e) {
                    e.preventDefault();

                    let tabName = this.getAttribute("href");

                    let tabContents = document.querySelector("#tab-contents");

                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
                        if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                        }
                        tabContents.children[i].classList.add("hidden");

                    }
                    e.target.parentElement.classList.add("bg-white", "border-blue-400", "border-b-4", "-mb-px", "opacity-100");
                });
            });
            document.getElementById("default-tab").click();
        }
    }

}
</script>

<style scoped>
@import './SysConfig.css';
</style>
