import { createRouter, createWebHistory } from 'vue-router'
import Gallery from "../views/pages/gallery/Gallery.vue";

//Instantiate the router

const routes = [


            {
                path: '/',
                name: 'dashboard',
                component: _=>import('../views/layouts/Dashboard.vue'),
                props: {name:'dashboard'},
                children:[
                    {
                        path: '/category',
                        name: 'category',
                        component: _=>import('../views/pages/category/Category.vue')
                    },
                    {
                        path: '/link',
                        name: 'link',
                        component: _=>import('../views/pages/link/Link.vue')
                    },
                    {
                        path: '/menu',
                        name: 'menu',
                        component: _=>import('../views/pages/menu/Menu.vue')
                    },
                    {
                        path: '/page',
                        name: 'page',
                        component: _=>import('../views/pages/page/Page.vue'),

                    },
                    {
                      path: 'page/create',
                      name: 'addPage',
                      component:_ =>   import('../views/pages/page/AddPage.vue'),
                    },
                    {
                        path: 'page/page-edit/:id',
                        name: 'editPage',
                        component:_ =>   import('../views/pages/page/EditPage.vue'),
                        props:true
                    },
                    {
                        path: '/post',
                        name: 'post',
                        component: _=>import('../views/pages/post/Post.vue')
                    },
                    {
                        path: '/video',
                        name: 'video',
                        component: _=>import('../views/pages/video/Video.vue')
                    },
                    {
                        path: '/service',
                        name: 'service',
                        component: _=>import('../views/pages/service/Service.vue')
                    },
                    {
                        path: '/scroller',
                        name: 'scroller',
                        component: _=>import('../views/pages/scroller/Scroller.vue')
                    },
                    {
                        path: '/slider',
                        name: 'slider',
                        component: _=>import('../views/pages/slider/Slider.vue')
                    },
                    {
                        path: '/webSetting',
                        name: 'webSetting',
                        component: _=>import('../views/pages/webSetting/WebSetting.vue')
                    },
                    {
                        path: '/gallery',
                        name: 'gallery',
                        component: _ => import('../views/pages/gallery/Gallery.vue')
                    },
                    {
                        path: '/mediaManager',
                        name: 'mediaManager',
                        component: _ => import('../views/pages/mediaManager/MediaManager.vue'),

                    }
                ]
            },

]
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})
router.beforeEach((to, from, next) => {
    // Get the page title from the route meta data that we have defined
    // See further down below for how we setup this data
    const title = to.meta.title

    //Take the title from the parameters
    const titleFromParams = to.params.pageTitle;
    // If the route has a title, set it as the page title of the document/page
    if (title) {
        document.title = title
    }
    // If we have a title from the params, extend the title with the title
    // from our params
    if (titleFromParams) {
        document.title = `${titleFromParams} - ${document.title}`;
    }
    // Continue resolving the route
    next()
})
export default router
