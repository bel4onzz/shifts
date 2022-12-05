import { createWebHistory, createRouter } from "vue-router";

const router = new createRouter({
    history: createWebHistory(),
    linkActiveClass:'active',
    routes: [
        {
            path: "/:catchAll(.*)",
            name: "Page Not Found",
            component: () => import('../views/_404.vue'),
        },

        {
            path: "/",
            name: "Home",
            component: () => import('../views/Home.vue'),
        },
        {
            path: "/employee",
            name: "Employee",
            component: () => import('../views/Employee.vue'),
        },
        {
            path: "/create",
            name: "Create",
            component: () => import('../views/CreateShift.vue'),
        },
    ]
});

export default router;
