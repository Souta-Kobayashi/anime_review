import './bootstrap';

import { createApp } from 'vue';
import router from './router';
import App from './App.vue';

// Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
// import * as components from 'vuetify/components';
// import * as directives from 'vuetify/directives';
import { aliases, mdi } from 'vuetify/iconsets/mdi';
import '@mdi/font/css/materialdesignicons.css'; // Ensure you are using css-loader

const vuetify = createVuetify({
  theme: {
    dark: false,
    default: 'light',
    disable: false,
    options: {
      cspNonce: undefined,
      customProperties: undefined,
      minifyTheme: undefined,
      themeCache: undefined,
    },
    themes: {
      light: {
        primary: '#1976D2',
        secondary: '#424242',
        accent: '#82B1FF',
        error: '#FF5252',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FB8C00',
      },
    },
  },
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
});

/* fontawesome */
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fab);

// custom components
import BaseHeader from './organisms/BaseHeader.vue';
import BaseFooter from './organisms/BaseFooter.vue';

const app = createApp(App);
app
  .component('FontAwesomeIcon', FontAwesomeIcon)
  .component('BaseHeader', BaseHeader)
  .component('BaseFooter', BaseFooter);
app.use(router).use(vuetify);
app.mount('#app');
