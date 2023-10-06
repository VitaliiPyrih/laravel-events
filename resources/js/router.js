import {createRouter, createWebHistory} from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('@/components/Index.vue'),
        name: 'index',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// router.beforeEach((to, from, next) => {
//     const accessToken = localStorage.getItem('access_token')
//     if(!accessToken) {
//         if(to.name === 'fruit.login' || to.name === 'fruit.registration') {
//             return next()
//         } else {
//             return next({name: 'fruit.login'})
//         }
//     }
//     if(to.name === 'fruit.login' || to.name === 'fruit.registration' && accessToken) {
//         return next({
//             name: 'user.personal'
//         })
//     }
//     next();
// })

export default router;
