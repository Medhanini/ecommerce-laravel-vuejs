import index from './pages/index.vue';
import products from './pages/products.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: index
    },
    {
        name: 'products',
        path: '/products',
        component: products
    }
];