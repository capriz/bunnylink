import TotalDetailChart from "./Charts/TotalDetailChart";

require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
    resolve: name => import(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init();

window.catchError = function(errors) {
    console.log(errors);
    var message = '';
    $.each(errors, function (index, item) {
        $.each(item, function (index, item) {
            message += item + '<br>';
        })
    });
    alertify.alert('Please fill necessary fields.', message, function () {
        alertify.error('Please try again.');
    });
};

