// import { createRouter, createWebHistory } from 'vue-router'
// import { createApp } from 'vue';

// import example from "./components/ExampleComponent.vue"
// import index from "./components/index.vue"

// const router = createRouter({
//   history: createWebHistory(),
//   routes: [
//     {
//       path: "/",
//       name: "example",
//       components: example
//     },
//     {
//       path: "/index",
//       name: "index",
//       components: index
//     },
//   ]
// })

// const app = createApp(App)
// app.use(router)

// export default app;

import {createRouter,createWebHistory} from 'vue-router';
import IndexComponent from "./components/IndexComponent";

const routes = [
  { 
    path: '/', 
    name: 'index',
    component: IndexComponent 
  },
]
 
const router = createRouter({
  history: createWebHistory(),
  routes,
})
 
export default router;