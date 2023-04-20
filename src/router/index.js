import { createRouter, createWebHashHistory  } from 'vue-router'
import HomeView from '../pages/HomeView.vue'
import store from '@/store';


const ifAuth = (to,from,next) => {
  const data = store.getters.token;
  if(data != null && data != undefined && data != '') {
    return next();
  }
  return next({ name: 'signUp' });
}

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path : '/about',
    name: 'about',
    component: () => import('../pages/AboutView.vue')
  },
  {
    path : '/contact',
    name: 'contact',
    component: () => import('../pages/ContactView.vue')
  },
  {
    path : '/courses',
    name: 'courses',
    component: () => import('../pages/CoursesView.vue')
  },
  {
    path : '/signUp',
    name: 'signUp',
    component: () => import('../pages/SignUpView.vue')
  },
  {
    path : '/library',
    name: 'library',
    component: () => import('../pages/LibraryView.vue'),
    beforeEnter : ifAuth
  },
  {
    path : '/detail',
    name : 'detail',
    component: () => import('../pages/CourseDetail.vue')
  }
  

]

const router = createRouter({
  history: createWebHashHistory(),
  // mode: 'history',
  routes
})

export default router
