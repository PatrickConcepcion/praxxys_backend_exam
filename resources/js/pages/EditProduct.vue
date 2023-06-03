<template>
    <div class="container">
        <h3 class="text-center fw-bold">Edit Product</h3>
        <div v-if="firstStep">
            <div class="card px-3 py-4">
                <form @submit.prevent="checkFirstValidation">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" v-model="name">
                    </div>
                    <div class="form-group mt-3">
                        <label>Category</label>
                        <select class="form-select" v-model="category">
                            <option value="" selected disabled>Choose Category</option>
                            <option value="Cosmetics">Cosmetics</option>
                            <option value="Food and Beverage">Food and Beverage</option>
                            <option value="Laundry">Laundry</option>
                            <option value="Medicines">Medicines</option>
                            <option value="Electronics">Electronics</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label>Description</label>
                        <Tiptap  v-model="description" />
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-success">Next</button>
                    </div>
                </form>
            </div>
        </div>
        <div v-if="secondStep">
            <div class="card px-3 py-4">
                <form @submit.prevent="checkSecondValidation">
                    <div class="form-group">
                        <label>Image Upload</label>
                        <input class="form-control" multiple type="file" @change="upload">
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-success">Next</button>
                    </div>
                </form>
            </div>
        </div>
        <div v-if="thirdStep">
            <div class="card px-3 py-4">
                <form @submit.prevent="checkThirdValidation">
                    <div class="form-group">
                        <label>Date and Time</label>
                        <input type="datetime-local" class="form-control" v-model="date_and_time">
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Tiptap from '@/components/Tiptap.vue'

export default {
    name: 'Edit Product',
    props: [
       'product_id'
    ],
    components: {
        Tiptap
    },
    data() {
        return {
            firstStep: true,
            secondStep: false,
            thirdStep: false,
            name: '',
            category: '',
            description: '',
            images: [],
            date_and_time: '',
        }
    },
    methods: {
        async getProductData() {
            await axios.get('/api/products/' + this.product_id)
            .then((response) => {
                this.name = response.data.product.name,
                this.category = response.data.product.category
                this.description = response.data.product.description
                this.date_and_time = response.data.date_and_time
            })
            .catch(error => console.log(error))
        },
        async checkFirstValidation() {
            await axios.post('/api/products/validate/first', {
                name: this.name,
                category: this.category,
                description: this.description
            })
            .then(()=>{
                this.firstStep = false
                this.secondStep = true
            })
            .catch(error => console.log(error))
        },
        async checkSecondValidation() {
            await axios.post('/api/products/validate/second', {
                images: this.images
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(()=>{
                this.secondStep = false,
                this.thirdStep = true
            })
            .catch(error => console.log(error))
        },
        async checkThirdValidation() {
            await axios.post('/api/products/validate/third', {
                date_and_time: this.date_and_time
            })
            .then((response) => {
                console.log(response)
                this.saveProduct()
            })
            .error(error => console.log(error))
        },
    },
    created() {
        this.getProductData()
    }
}
</script>
<style lang="">
    
</style>