<template>
    <div class="container">
        <div class="mx-auto">
            <!--検索フォーム-->
            <div class="row">
                <div class="col-sm">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">食品名</label>
                        <!--入力-->
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="searchWord" v-model="searchName">
                        </div>
                    </div>     
                    <!--プルダウンカテゴリ選択-->
                    <div class="form-group row">
                        <label class="col-sm-2">カテゴリー</label>
                        <div class="col-sm-3">
                            <select class="col-sm-9 form-select" id="middle_category" v-model="searchMiddleCategory">
                                <option disabled value="initial">選択してください</option>
                                <option value="">全て</option>
                                <option v-for="middleCategory in middleCategorys" :key="middleCategory"  v-bind:value="middleCategory.middle_category">{{middleCategory.middle_category}}</option>
                            </select>
                        <div class="col-sm-auto">
                            <button type="submit" class="btn btn-primary" v-on:click="getFoodsSearch()">検索</button>
                        </div>
                        </div>
                    </div>
                <button class="btn btn-success" @click="getFoodsCsv()">CSV_DL</button>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">カテゴリー</th>
                <th scope="col">食品名</th>
                <th scope="col" @click="getFoodsSort('amount')">量(g)</th>
                <th scope="col" @click="getFoodsSort('calorie')">カロリー(kcal)</th>
                <th scope="col" @click="getFoodsSort('protein')">タンパク質(g)</th>
                <th scope="col" @click="getFoodsSort('fat')">脂質(g)</th>
                <th scope="col" @click="getFoodsSort('carbohydrate')">炭水化物(g)</th>
                <th scope="col">詳細</th>
                <th scope="col">編集</th>
                <th scope="col">削除</th>
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
                        <button class="btn btn-primary">詳細</button>
                    </router-link>
                </td>
                <td>
                    <router-link v-bind:to="{name: 'food.edit', params: {foodId: food.id }}">
                        <button class="btn btn-success">編集</button>
                    </router-link>
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="deletefood(food.id)">削除</button>
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
            majorCategorys: [],
            middleCategorys: [],
            searchMiddleCategory: '',
            searchName: '',
            sortColumn: '',
            orderby: false,
            orderbyKey: '',
            items: [
                { name: 'りんご', price: '100' },
                { name: 'みかん', price: '50' },
                { name: 'マンゴー', price: '3000' }
            ]
        }
    },
    methods: {
        async getfoods() {
            localStorage.removeItem('Key');
            await axios.get(`/api/foods?page=${this.current_page}`)
                .then((res) => {
                    this.current_page = res.data.current_page;
                    this.last_page = res.data.last_page;
                    this.foods = res.data.data;
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
                if(!this.searchMiddleCategory && !this.searchName){
                    this.getfoods();
                } else {
                    this.getFoodsSearch();
                }
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
        },
                getMajorCategory(){
            axios.get('/api/foods/get_major_category')
                .then((res) => {
                this.majorCategorys = res.data;
            })
        },
        getMiddleCategory(){
            axios.get('/api/foods/get_middle_category')
                .then((res) => {
                this.middleCategorys = res.data;
            })
        },
        getFoodsSearch(){
            localStorage.removeItem('Key');
            console.log(this.searchMiddleCategory);
            axios.get(`/api/foods/search?page=${this.current_page}`, {params: {middle_category:this.searchMiddleCategory, name:this.searchName}})
                .then((res) => {
                    console.log(res.data);
                    this.current_page = res.data.current_page;
                    this.last_page = res.data.last_page;
                    this.foods = res.data.data;
            })
        },
        getFoodsSort(column){
            if(JSON.parse(localStorage.getItem('Key'))){
                var jsonObj = localStorage.getItem('Key');
                var jsObj = JSON.parse(jsonObj);
                if(column == jsObj.sort){
                } else {
                    this.orderby = true;
                }
            }
            var obj = {
                sort: column,
            }
            var obj = JSON.stringify(obj);
            localStorage.setItem('Key', obj);
            axios.get(`/api/foods/sort?page=${this.current_page}`, 
            {params: {
                middle_category: this.searchMiddleCategory,
                name: this.searchName,
                sort_column: column,
                orderby: this.orderby,
                orderby_key: this.orderbyKey,
                }})
                .then((res) => {
                    console.log(res.data);
                    this.current_page = res.data.current_page;
                    this.last_page = res.data.last_page;
                    this.foods = res.data.data;
                    this.orderby = !this.orderby;
            })
        },
        getFoodsCsv(){
            window.confirm('全ての食品データをCSVでダウンロードしますがよろしいでしょうか？');
            var csv = '\ufeff' + 'No, 大分類, 中分類, 食品名, 量(g), カロリー(kcal), タンパク質(g), 脂質(g), 炭水化物(g)\n'
            axios.get('/api/foods/csv')
                .then((res) => {
                    console.log(res.data);
                    res.data.forEach(el => {
                        var line = 
                        el.id + 
                        ',' + el.major_category + 
                        ',' + el.middle_category + 
                        ',' + el.name + 
                        ',' + el.amount + 
                        ',' + el.calorie + 
                        ',' + el.protein + 
                        ',' + el.fat + 
                        ',' + el.carbohydrate + 
                        '\n'
                        csv += line
                    })
                    let blob = new Blob([csv], { type: 'text/csv' })
                    let link = document.createElement('a')
                    link.href = window.URL.createObjectURL(blob)
                    link.download = 'foods_data.csv'
                    link.click()
            })
        },
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
        },
    },
    mounted() {
        this.getMajorCategory(); 
        this.getMiddleCategory(); 
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