import Component from './Modal.vue'
let Plugin = {
    install: function(Vue, options = {}) {
         Vue.component('modal', Component)

         Vue.prototype.$modal = {
             show(name) {
                location.hash = name;
             },

             hide(name) {
                location.hash = '#';
             }
         }
    }
};

export default Plugin;