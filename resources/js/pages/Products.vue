<template>
    <div class="container">
        <h3 class="text-center fw-bold">Products</h3>
        <div class="d-flex align-items-center mb-2">
            <h6 class="fst-italic m-0 p-0 me-1 fw-bold">Search</h6>
            <input type="text" v-model="search"  class="form-control ms-2">
            <select class="form-select ms-2" v-model="category">
                <option value="" selected disabled>Filter by Category</option>
                <option value="Cosmetics">Cosmetics</option>
                <option value="Food and Beverage">Food and Beverage</option>
                <option value="Laundry">Laundry</option>
                <option value="Medicines">Medicines</option>
                <option value="Electronics">Electronics</option>
            </select>
            <a :href="`/products/create`" class="btn btn-success">Create</a>
        </div>
        <div>
            <div class="row mx-auto">
                <div v-for="product in paginatedProducts" :key="product.id" class="col-12 col-md-8 col-lg-4 py-2 px-3 mx-auto border rounded">
                    <div class="product mx-auto">
                        <h4 class="text-center my-3 fw-bold">{{ product.name }}</h4>
                        <p class="fst-italic">Description:</p>
                        <p class="description">{{ product.description }}</p>
                        <p><span class="fst-italic">Category: </span>{{ product.category }}</p>
                        <p class="fst-italic">Product listed last {{ product.date_and_time }}</p>
                        <div class="float-end">
                            <a :href="`/products/edit/${product.id}`">
                                <box-icon class=" action" name='edit' color="green" type='solid'></box-icon>
                            </a>
                            <box-icon class="ms-2 action" color="red" type='solid' name='trash-alt' @click="deleteProduct(product.id)"></box-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="products.length > 0 " class = "d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <span class="results-count">Showing <b>{{this.startOfPage}}</b> to <b>{{this.lastOfPage + paginatedProducts.length}}</b> of <b>{{products.length}}</b> results </span>
            </div>
            <div>
                <Pagination
                    :products="products"
                    :currentPage="currentPage"
                    :pageSize="pageSize"
                    :totalPages="Math.ceil(this.filteredList.length / this.pageSize)"
                    @pagechange="onPageChange">
                </Pagination>
            </div>
        </div>
    </div>
</template>
<script>
import Pagination from '@/components/Pagination.vue'
import {ref} from 'vue'
import 'boxicons'

export default {
    name: 'Products',
    data() {
        return {
            products: [],
            currentPage: ref(1),
            pageSize: 6,
            totalPages: 0, 
            startOfPage: 1,
            lastOfPage: 0,
            search: ref(''),
            category: ''
        }
    },
    components: {
        Pagination
    },
    computed:{
        paginatedProducts(){
            let products = this.filteredList.slice((this.currentPage - 1) * this.pageSize, this.currentPage * this.pageSize);
            return products;
        },

        filteredList() {
            if(this.search){
                return this.products.filter((product) => {
                    return product.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        product.description.toLowerCase().includes(this.search.toLowerCase()
                    )
                })
            } else if (this.category){
                return this.products.filter((product) => {
                    return product.category.toLowerCase().includes(this.category.toLowerCase())
                })
            } else {
                return this.products;
            }
        },
    },
    methods: {
        onPageChange(pageNum){
            this.currentPage = pageNum;
            this.startOfPage = (pageNum * this.pageSize) - (this.pageSize - 1);
            this.lastOfPage = (pageNum - 1) * this.pageSize;
        },
        async fetchProducts(){
            axios.get('/api/products/')
            .then(response => this.products = response.data.products)
            .catch(error => console.log(error))
        },
        async deleteProduct(id) {
            axios.delete('/api/products/' + id)
            .then(()=>{
                this.fetchProducts()
            })
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
    .action {
        cursor:pointer;
    }
</style>