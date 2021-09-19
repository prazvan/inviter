require('./bootstrap');

window.Vue = require('vue').default;

// import SPA routes
import router from './router';

// import layout
import App from './layout/App';

new Vue({
    router,
    el: '#InviterApp',
    render: h => h(App)
});
