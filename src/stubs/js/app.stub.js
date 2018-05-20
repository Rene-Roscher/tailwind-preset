import './bootstrap';

import ExampleComponent from './components/ExampleComponent.vue';

Vue.component('example-component', ExampleComponent);

const app = new Vue({
    el: '#app',

    methods: {
        logout() {
            this.$refs.logoutForm.submit();
        }
    }
});
