import { createRouter, createWebHistory } from 'vue-router'
import LoginUser from '../views/LoginuserView.vue'
import DashBoardsView from '../views/DashboardView.vue'
import UserCrudView from '../views/UserCrudView.vue'
import EditUserView from '../views/EditUserView.vue'
import FormPostView from '../views/FormPostView.vue'
import ProfilePageView from '../views/ProfilePageView.vue'
import SignupView from '../views/SignupView.vue'
import CommentsCrudView from '../views/CommentCrudView.vue'
import PostsCrudView from '../views/PostCrudView.vue'
import ForgotPasswordView from '../views/ForgotPasswordView.vue'
import UserDashboardView from '../views/UserDashboardView'
//import ResetPassword from '../components/ResetPassword.vue'
import auth from '../middleware/auth.js'
import log from '../middleware/log.js'
import admin from '../middleware/admin.js'


const routes = [
  
  
]

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/HomeView.vue'),
      meta: {
                middleware: [log],
            },
    },
    {
      path: '/post/:id',
      name: 'PostDetail',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/PostView.vue'),
      meta: {
        middleware: [log],
      },
    },
    {
    path: '/user/edit/:id',
      name: 'EditUsers',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: EditUserView,
      meta: {
        middleware: [log, admin],
      },
    },
    {
      path: '/users',
      name: 'UserListing',
      component: UserCrudView,
      meta: {
                middleware: [log, admin],
            },
    },
    {
    path: '/ProfilePage/:id',
    name: 'ProfilePage',
    component: ProfilePageView,
    meta: {
      middleware: [log],
  },
    },
  
    
    {
      path: '/signup',
      name: 'Signup',
      component: SignupView,
      meta: {
        middleware: [auth],
      },
      
    },
    {
      path: '/forgotPassword',
      name: 'forgotPassword',
      component: ForgotPasswordView,
      meta: {
        middleware: [auth],
      },
    },
    
    {
      path: '/login',
      name: 'login',
      component: LoginUser,
      meta: {
        middleware: [auth],
      },
    },
    {
      path: '/createpost',
      name: 'newpost',
      component: FormPostView,
      meta: {
        middleware: [log],
      },
    },
    {
      path: '/comments',
      name: 'CommentsCrudView',
      component: CommentsCrudView
    },
    {
      path: '/posts',
      name: 'PostsCrudView',
      component: PostsCrudView
    },
    {
      path: '/dashboard',
      name: 'DashboardView',
      component: DashBoardsView
    },
    {
      path: '/test',
      name: 'test',
      component: () => import('../components/test.vue')
    },
    {
      path:'/userdashboard',
      name:'UserDashBoardView',
      component: ()=>('../views/UserDashboardView.vue')
    }
    /*{
      path: '/resetPassword/:token',
      name:'resetPassword',
      component: ResetPassword,
    }*/
  ]
})

// Creates a `nextMiddleware()` function which not only
// runs the default `next()` callback but also triggers
// the subsequent Middleware function.
function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;
  
    return (...parameters) => {
      // Run the default Vue Router `next()` callback first.
      context.next(...parameters);
      // Then run the subsequent Middleware with a new
      // `nextMiddleware()` callback.
      const nextMiddleware = nextFactory(context, middleware, index + 1);
      subsequentMiddleware({ ...context, next: nextMiddleware });
    };
  }
  
  router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
      const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];
  
      const context = {
        from,
        next,
        router,
        to,
      };
      const nextMiddleware = nextFactory(context, middleware, 1);
  
      return middleware[0]({ ...context, next: nextMiddleware });
    }
  
    return next();
  });

export default router
