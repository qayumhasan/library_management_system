import store from '@/store';
import isPermit from '@/services/auth/permission.js'
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';
const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach( async (to, from, next) => {

    // await store.dispatch('auth/userVarify');
    const isAuthenticated = localStorage.getItem("user_info");
    const role = to.meta.role;
    const isAllowed = isPermit(role);
    if(!isAllowed){
        return next({ name: 'unauthorize' });
    }
    if(isAuthenticated && to.name == 'login'){
        return next({ name: 'home' });
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (isAuthenticated) {
            if (to.name == 'login') {
                return next({ name: 'home' });
            }
        }else{

            if (to.name !== 'login') {
                return next({ name: 'login' });
            }
        }
    }

    next();
});

export default router
