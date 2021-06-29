const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const Login = () => import('./views/Login.vue' /* webpackChunkName: "resource/js/views/login" */)
const UserList = () => import('./components/user/List.vue' /* webpackChunkName: "resource/js/components/category/list" */)
const UserCreate = () => import('./components/user/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
const UserEdit = () => import('./components/user/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)
const CustomerList = () => import('./components/customer/List.vue' /* webpackChunkName: "resource/js/components/category/list" */)
const CustomerCreate = () => import('./components/customer/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
const CustomerEdit = () => import('./components/customer/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)

export const routes = [
  {
    name: 'home',
    path: '/',
    component: Welcome
  },
  {
    name: 'login',
    path: '/login',
    component: Login
  },
  {
    name: 'userList',
    path: '/user',
    component: UserList
  },
  {
    name: 'userEdit',
    path: '/user/:id/edit',
    component: UserEdit
  },
  {
    name: 'userAdd',
    path: '/user/add',
    component: UserCreate
  },
  {
    name: 'customerList',
    path: '/customer',
    component: CustomerList
  },
  {
    name: 'customerEdit',
    path: '/customer/:id/edit',
    component: CustomerEdit
  },
  {
    name: 'customerAdd',
    path: '/customer/add',
    component: CustomerCreate
  }
]
