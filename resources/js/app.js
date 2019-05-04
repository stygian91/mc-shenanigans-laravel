
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });


window.addEventListener('DOMContentLoaded', () => {
  const $deleteButtons = document.querySelectorAll('.btn-delete');
  for (const $button of $deleteButtons) {
    $button.addEventListener('click', event => {
      const sure = window.confirm('Are you sure?');
      if (!sure) {
        return;
      }

      const $form = $button
        .closest('.card')
        .querySelector('.form-delete');

      if ($form) {
        $form.submit();
      }
    });
  }

  const $coordinateInputs = document.querySelectorAll('.form-search-position input[type=text]');
  for (const $input of $coordinateInputs) {
    $input.addEventListener('keydown', event => {
      const $form = $input.closest('form');
      if (!$form) {
        return;
      }

      if (event.key === 'Enter') {
        $form.submit();
      }
    });
  }
});

