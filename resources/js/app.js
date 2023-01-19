/* eslint no-undef: "off" */
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
// import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName =
  window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  progress: {
    color: '#FF0000',
    showSpinner: true,
  },
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/*.vue')
    ),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .directive('click-outside', {
        mounted: function (el, binding) {
          el.clickOutsideEvent = function (event) {
            if (!(el == event.target || el.contains(event.target))) {
              binding.value(event, el);
            }
          };
          document.addEventListener('click', el.clickOutsideEvent);
        },
        unmounted: function (el) {
          document.removeEventListener('click', el.clickOutsideEvent);
        },
      })
      .mount(el);
  },
});

// InertiaProgress.init({ color: '#4B5563', showSpinner: true });
