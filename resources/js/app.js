import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import specific icons */
import { faLinkedinIn, faFacebook, faInstagram, faTiktok } from '@fortawesome/free-brands-svg-icons'
import { faEnvelope, faBars, faXmark } from '@fortawesome/free-solid-svg-icons'
library.add(faLinkedinIn, faFacebook, faInstagram, faTiktok, faEnvelope, faBars, faXmark )
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({
          render: () => h(App, props),
          data() {
            return {
              users: [], // Initialisez la variable users avec un tableau vide
            };
          },
        }).component('font-awesome-icon', FontAwesomeIcon)
          .use(plugin)
          .use(ZiggyVue, Ziggy);

        // Récupérez les utilisateurs depuis les props
        if (props.user) {
          app.config.globalProperties.$data.users = props.user;
        }

        return app.mount(el);
    },
    progress: {
        color: '#4B5563',
        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
});

