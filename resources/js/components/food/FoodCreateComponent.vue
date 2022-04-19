<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="major_category" class="col-sm-3 col-form-label">Major Category</label>
            <input type="text" class="col-sm-9 form-control" id="major_category" v-model="food.major_category">
          </div>
          <div class="form-group row">
            <label for="middle_category" class="col-sm-3 col-form-label">Middle Category</label>
            <input type="text" class="col-sm-9 form-control" id="middle_category" v-model="food.middle_category">
          </div>
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <input type="text" class="col-sm-9 form-control" id="name" v-model="food.name">
          </div>
          <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">Amount</label>
            <input type="text" class="col-sm-9 form-control" id="amount" v-model="food.amount">
          </div>
          <div class="form-group row">
            <label for="calorie" class="col-sm-3 col-form-label">Calorie</label>
            <input type="text" class="col-sm-9 form-control" id="calorie" v-model="food.calorie">
          </div>
          <div class="form-group row">
            <label for="protein" class="col-sm-3 col-form-label">Protein</label>
            <input type="text" class="col-sm-9 form-control" id="protein" v-model="food.protein">
          </div>
          <div class="form-group row">
            <label for="fat" class="col-sm-3 col-form-label">Fat</label>
            <input type="text" class="col-sm-9 form-control" id="fat" v-model="food.fat">
          </div>
          <div class="form-group row">
            <label for="carbohydrate" class="col-sm-3 col-form-label">Carbohydrate</label>
            <input type="text" class="col-sm-9 form-control" id="carbohydrate" v-model="food.carbohydrate">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        food: {}
      }
    },
    methods: {
      submit() {
        axios.post('/api/foods', this.food)
          .then((res) => {
            this.$router.push({name: 'food.list'});
          })
          .catch(error => {
            console.log(error)
          })
      }
    },
  }
</script>