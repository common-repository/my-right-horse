import 'core-js/fn/object/assign';
import 'bootstrap';
import Vue from 'vue';
import App from './vue/App.vue';
import _ from 'lodash';
import Rollbar from 'rollbar';

Vue.prototype.$rollbar = new Rollbar({
  accessToken: 'bcba4d510a7b425cb3a12b18e24552ca',
  captureUncaught: true,
  captureUnhandledRejections: true,
});

Vue.prototype.$http = axios;

Vue.config.errorHandler = (err, vm, info) => {
  vm.$rollbar.error(err);
  throw err; // rethrow
};

var vm = new Vue({
  el: '#mrh',
  render: h => h(App),
});

Vue.directive('click-outside', {
  bind: function(el, binding, vnode) {
    el.clickOutsideEvent = function(event) {
      // here I check that click was outside the el and his childrens
      if (
        !(el == event.target || el.contains(event.target)) &&
        !event.target.classList.contains('prevent-outclick')
      ) {
        // and if it did, call method provided in attribute value
        vnode.context[binding.expression](event);
      }
    };
    document.body.addEventListener('click', el.clickOutsideEvent);
  },
  unbind: function(el) {
    document.body.removeEventListener('click', el.clickOutsideEvent);
  },
});
