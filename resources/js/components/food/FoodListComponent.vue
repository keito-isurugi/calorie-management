<template>
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">No.</th>
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
                    <router-link v-bind:to="{name: 'food.show', params: {foodId: food.id }}">
                        <button class="btn btn-primary">Show</button>
                    </router-link>
                </td>
                <td>
                    <router-link v-bind:to="{name: 'food.edit', params: {foodId: food.id }}">
                        <button class="btn btn-success">Edit</button>
                    </router-link>
                </td>
                <td>
<button class="btn btn-danger" v-on:click="deletefood(food.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <ul class="pagination">
                <li
                    class="inactive"
                    :class="(current_page == 1) ? 'disabled' : ''"
                    @click="changePage(current_page-1)"
                >«</li>
                <li 
                    v-for="page in frontPageRange" 
                    :key="page" 
                    @click="changePage(page)"
                    :class="(isCurrent(page)) ? 'active' : 'inactive'"
                    >{{ page }}</li>
                <li v-show="front_dot" class="inactive disabled">...</li>
                <li 
                    v-for="page in middlePageRange" 
                    :key="page" 
                    @click="changePage(page)"
                    :class="(isCurrent(page)) ? 'active' : 'inactive'"
                    >{{ page }}</li>
                <li v-show="end_dot" class="inactive disabled">...</li>
                <li 
                    v-for="page in endPageRange" 
                    :key="page" 
                    @click="changePage(page)"
                    :class="(isCurrent(page)) ? 'active' : 'inactive'"
                    >{{ page }}</li>
                <li
                    class="inactive"
                    :class="(current_page >= last_page) ? 'disabled' : ''"
                    @click="changePage(current_page+1)"
                >»</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            foods: [],
            current_page:1,
            last_page: "",
            range: 5,
            front_dot: false,
            end_dot: false,
        }
    },
    methods: {
        async getfoods() {
            await axios.get(`/api/foods?page=${this.current_page}`)
                .then((res) => {
                    this.current_page = res.data.current_page;
                    this.last_page = res.data.last_page;
                    this.foods = res.data.data;
                    console.log(res);
                });
        },
        calRange(start,end) {
            const range = [];
            for (let i = start; i <= end; i++) {
                range.push(i);
            }
            return range;
        },
        changePage(page) {
            if (page > 0 && page <= this.last_page) {
                this.current_page = page;
                this.getfoods();
            }
        },
        isCurrent(page) {
            return page === this.current_page;
        },
        async deletefood(id) {
            await axios.delete('/api/foods/' + id)
                .then((res) => {
                    this.getfoods();
                });
        }
    },
    computed: {
        frontPageRange() {
        return this.calRange(1, 2);
        },
        middlePageRange() {
        let start = "";
        let end = "";
        if (this.current_page <= this.range) {
            start = 3;
            end = this.range + 2;
            this.front_dot = false;
            this.end_dot = true;
        } else if (this.current_page > this.last_page - this.range) {
            start = this.last_page - this.range - 1;
            end = this.last_page - 2;
            this.front_dot = true;
            this.end_dot = false;
        } else {
            start = this.current_page - Math.floor(this.range / 2);
            end = this.current_page + Math.floor(this.range / 2);
            this.front_dot = true;
            this.end_dot = true;
        }
        return this.calRange(start, end);
        },
        endPageRange() {
        return this.calRange(this.last_page - 1, this.last_page);
        }
    },
    created() {
        this.getfoods();
    }
}
</script>

<style scoped>
.pagination {
    display: flex;
    list-style-type: none;
}
.pagination li {
    border: 1px solid #ddd;
    padding: 6px 12px;
    text-align: center;
    cursor: pointer;
}
.pagination li + li {
    border-left: none;
}
.active {
    background-color: rgb(89, 153, 250);
    color:white;
    }
.inactive{
    color: rgb(89, 153, 250);
}
.disabled {
    cursor: not-allowed;
}
</style>