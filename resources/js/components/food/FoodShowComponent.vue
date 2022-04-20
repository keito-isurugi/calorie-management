<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form>
          <div class="form-group row border-bottom">
            <label for="id" class="col-sm-3 col-form-label">ID</label>
            <p class="col-sm-9 form-control-plaintext">{{ foodId }}</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="middle_category" class="col-sm-3 col-form-label">Middle Category</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.middle_category }}</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.name }}</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="amount" class="col-sm-3 col-form-label">Amount</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.amount }}g</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="calorie" class="col-sm-3 col-form-label">Calorie</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.calorie }}kcal</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="protein" class="col-sm-3 col-form-label">Protein</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.protein }}g</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="fat" class="col-sm-3 col-form-label">Fat</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.fat }}g</p>
          </div>
          <div class="form-group row border-bottom">
            <label for="carbohydrate" class="col-sm-3 col-form-label">Carbohydrate</label>
            <p class="col-sm-9 form-control-plaintext">{{ food.carbohydrate }}g</p>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
        foodId: String
    },
    data: function () {
      return {
        food: {}
      }
    },
    methods: {
      getFood(){
        axios.get('/api/foods/' + this.foodId)
          .then((res) => {
            this.food = res.data;
          })
      },
    },
    mounted() {
        this.getFood();
    }
  }
</script>