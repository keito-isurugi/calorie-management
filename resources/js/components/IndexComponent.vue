<template>
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Middle Category</th>
                <th scope="col">Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Calorie</th>
                <th scope="col">Protein</th>
                <th scope="col">Fat</th>
                <th scope="col">Carbohydrate</th>
                <th scope="col">Show</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="food in foods" :key="food.id">
                <th scope="row">{{ food.id }}</th>
                <td>{{ food.middle_category }}</td>
                <td>{{ food.name }}</td>
                <td>{{ food.amount }}g</td>
                <td>{{ food.calorie }}kcal</td>
                <td>{{ food.protein }}g</td>
                <td>{{ food.fat }}g</td>
                <td>{{ food.carbohydrate }}g</td>
                <td>
                  <!-- <router-link v-bind:to="{name: 'food.show', params: {foodId: food.id }}"> -->
                    <button class="btn btn-primary">Show</button>
                  <!-- </router-link> -->
                </td>
                <td>
                    <!-- <router-link v-bind:to="{name: 'food.edit', params: {foodId: food.id }}"> -->
                        <button class="btn btn-success">Edit</button>
                    <!-- </router-link> -->
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="deletefood(food.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            foods: []
        }
    },
    methods: {
        getfoods() {
            axios.get('/api/foods')
                .then((res) => {
                    this.foods = res.data;
                });
        }
    },
    mounted() {
        this.getfoods();
    }
}
</script>