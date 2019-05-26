
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

const updateLocation = $tr => {
  const url = $tr.getAttribute('data-url');

  const x = $tr.querySelector('input[name=x]').value;
  const y = $tr.querySelector('input[name=y]').value;
  const z = $tr.querySelector('input[name=z]').value;
  const name = $tr.querySelector('input[name=name]').value;
  const $select = $tr.querySelector('select');
  const type = $select.options[$select.selectedIndex].value;

  axios.post(url, {
    _method: 'PATCH',
    x,
    y,
    z,
    name,
    type,
  }).then(response => {
    alert('Location updated successfully.')
  }).catch(error => {
    alert('There was an error while updating the entry.');
  });
};

window.addEventListener('DOMContentLoaded', () => {
  const $deleteButtons = document.querySelectorAll('.btn-delete');
  for (const $button of $deleteButtons) {
    $button.addEventListener('click', event => {
      const sure = window.confirm('Are you sure you want to delete this location?');
      if (!sure) {
        return;
      }

      const $tr = $button.closest('tr');
      const url = $tr.getAttribute('data-url');

      axios.post(url, { _method: 'DELETE' }).then(response => {
        $tr.remove();
      }).catch(error => {
        alert('There was an error while deleting the entry.');
      });
    });
  }

  const $updateButtons = document.querySelectorAll('.btn-update');
  for (const $button of $updateButtons) {
    $button.addEventListener('click', event => {
      const $tr = $button.closest('tr');
      updateLocation($tr);
    });
  }

  const $coordinateInputs = document.querySelectorAll('.form-search input[type=text]');
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
