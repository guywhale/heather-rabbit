import Alpine from 'alpinejs';

document.addEventListener('DOMContentLoaded', () => {
  /**
   * Initialize Alpine
   */
  window.Alpine = Alpine;
  Alpine.start();

  /**
   * Main init function
   */
  init();

  function init() {
    console.log('Welcome to Hwale.');

    if (document.querySelector('[data-example-script]')) {
      console.log('YUP');
      const examplesScripts = document.querySelectorAll('[data-example-script]');

      /**
       * Example of how to dynamically enqueue vanilla JS files when needed.
       */
      import('./js/ExampleScript.js')
        .then((ExamplesScript) => {
          [...examplesScripts].map(el => ExamplesScript.default(el));
        })
        .catch((err) => {
          console.log(err);
        });
    }
  }
});
