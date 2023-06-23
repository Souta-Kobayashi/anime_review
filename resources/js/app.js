import './bootstrap';

import { createApp } from 'vue';
import router from './router';
import App from './App.vue';

/* fontawesome */
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faGithub, faTwitter } from '@fortawesome/free-brands-svg-icons';
library.add([faGithub, faTwitter]);

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.mount("#app");