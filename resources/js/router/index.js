import { createWebHistory, createRouter } from 'vue-router';
import auth from './middleware/auth';
import Login from '../pages/Login';
import Registration from '../pages/Registration';
import Home from "../pages/Home";
import Profile from "../pages/Profile";
import Tracks from "../pages/Tracks";
import Vacations from "../pages/Vacations";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            middleware: [ auth ],
            layout: 'main'
        }
    },
    {
        path: '/login',
        name: 'login',
        meta: { layout: 'auth' },
        component: Login
    },
    {
        path: '/registration',
        name: 'registration',
        meta: { layout: 'auth' },
        component: Registration
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: {
            middleware: [ auth ],
            layout: 'main'
        }
    },
    {
        path: '/tracks',
        name: 'tracks',
        component: Tracks,
        meta: {
            middleware: [ auth ],
            layout: 'main'
        }
    },
    {
        path: '/vacations',
        name: 'vacations',
        component: Vacations,
        meta: {
            middleware: [ auth ],
            layout: 'main'
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware
    const context = {
        to,
        from,
        next,
    }
    return middleware[0]({
        ...context
    })
})

export default router;
