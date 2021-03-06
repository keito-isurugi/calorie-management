import {createRouter,createWebHistory} from 'vue-router';
import FoodListComponent from "./components/food/FoodListComponent";
import FoodCreateComponent from "./components/food/FoodCreateComponent";
import FoodShowComponent from "./components/food/FoodShowComponent";
import FoodEditComponent from "./components/food/FoodEditComponent";
import UserRegisterComponent from "./components/user/UserRegisterComponent";

const routes = [
  { 
    path: '/foods', 
    name: 'food.list',
    component: FoodListComponent 
  },
  { 
    path: '/foods/create', 
    name: 'food.create',
    component: FoodCreateComponent,
  },
  { 
    path: '/foods/:foodId', 
    name: 'food.show',
    component: FoodShowComponent,
    props: true
  },
  { 
    path: '/foods/:foodId/edit', 
    name: 'food.edit',
    component: FoodEditComponent,
    props: true
  },
  { 
    path: '/user/register', 
    name: 'user.register',
    component: UserRegisterComponent,
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;