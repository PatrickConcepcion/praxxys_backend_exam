<template>
    <div class="container">
        <h3 class="text-center fw-bold">Products</h3>
        <div>
            <div class="row">
                <div v-for="product in products" class="col-12 col-md-8 col-lg-4 product-col shadow-lg py-2 px-3 m-3 rounded">
                    <h4 class="text-center my-3 fw-bold">{{ product.name }}</h4>
                    <p class="fst-italic">Description:</p>
                    <p class="description">{{ product.description }}</p>
                  
                    <p><span class="fst-italic">Category: </span>{{ product.category }}</p>
                    {{ product.date_and_time }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'Products',
    data() {
        return {
            products: [],
        }
    },
    methods: {
        async fetchProducts(){
            axios.get('/api/products/')
            .then(response => this.products = response.data.products)
            .catch(error => console.log(error))
        }
    },
    created(){
        this.fetchProducts()
    }
}
</script>
<style scoped>
    .description {
        text-align: justify;
        text-indent: 1rem;
    }

    .product-col {
        /* min-width: 300px; */
    }
</style>