import './bootstrap';
import App from './components/App.vue';
import { createRouter, createWebHistory } from 'vue-router';

import { createApp } from 'vue';

import List from './components/List.vue';
import Poll from './components/Poll.vue';
import Dashboard from './components/Dashboard.vue';
import Login from './components/Login.vue';
import AddPoll from './components/AddPoll.vue';
import NotFound from './components/NotFound.vue';

import VueCookies from 'vue-cookies';

import '../css/app.css';

let token = VueCookies.get('token') || '';
const app = createApp(App);
app.use(VueCookies, { expires: '15m' });

const notLoggedRoutes = [
    { path: '/', component: List },
    { path: '/poll/:idPath', component: Poll, props: true },
    { path: '/login', component: Login}
  ]
  
  const adminRoutes = [
    { path: '/', component: Dashboard },
    { path: '/poll/:idPath', component: Poll, props: true },
    { path: '/add-poll', component: AddPoll, props: true},
    { path: '/login', component: NotFound}
];

let routes = (!!token)?adminRoutes: notLoggedRoutes;

const router = createRouter({
// 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
})
app.use(router)

app.mount('#app');