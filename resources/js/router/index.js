import { createWebHistory, createRouter } from 'vue-router';
import Login from '../pages/Login';
import Registration from '../pages/Registration';

const routes = [
    {
        path: '/',
        component: Login
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/registration',
        component: Registration
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
