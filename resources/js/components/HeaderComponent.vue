<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">Calorie Management</span>
                <div>
                    <router-link v-bind:to="{name: 'food.list'}">
                        <button class="btn btn-success">List</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'food.create'}">
                        <button class="btn btn-success">Add</button>
                    </router-link>
                    <!-- <router-link v-bind:to="{name: 'food.create'}"> -->
                        <button class="btn btn-success">CSV_DL</button>
                    <!-- </router-link> -->
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {}
</script>