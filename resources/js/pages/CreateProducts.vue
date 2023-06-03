<template>
    <div class="container">
        <div v-if="firstStep">
            <div class="card px-3 py-4">
                <form @submit.prevent="checkFirstValidation">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" v-model="name">
                        <p class="text-danger m-0">{{ name_validation }}</p>
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
                        <p class="text-danger m-0">{{ category_validation }}</p>
                    </div>
                    <div class="form-group mt-3">
                        <label>Description</label>
                        <Tiptap  v-model="description" />
                        <p class="text-danger m-0">{{ description_validation }}</p>
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
                        <p class="text-danger m-0">{{ images_validation }}</p>
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
    name: 'Create Products',
    data() {
        return {
            firstStep: true,
            secondStep: false,
            thirdStep: false,
            images: [],
            name: '',
            category: '',
            description: 'I am an HTML Text Editor. Enter Description Here.',
            date_and_time: '',
            name_validation: '',
            category_validation: '',
            description_validation: '',
            images_validation: '',
        }
    },
    components: {
        Tiptap
    },
    methods: {
        upload(e){
            // var files = e.target.files || e.dataTransfer.files;
            // if (!files.length) return;
            // this.createImage(files);
            this.images = e.target.files;
        },
        // createImage(files) {
        //     var vm = this;
        //     for (var index = 0; index < files.length; index++) {
        //         var reader = new FileReader();
        //         reader.onload = function(event) {
        //             const imageUrl = event.target.result;
        //             vm.images.push(imageUrl);
        //         }
        //         reader.readAsDataURL(files[index]);
        //     }
        // },
        // removeImage(index) {
        //     this.images.splice(index, 1)
        // },
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
            .catch((error)=>{
                this.name_validation = ''
                this.category_validation = ''
                this.description_validation = ''

                if(error.response.data.errors.name) {
                    this.name_validation = error.response.data.errors.name[0]
                }

                if(error.response.data.errors.category) {
                    this.category_validation = error.response.data.errors.category[0]
                }

                if(error.response.data.errors.description) {
                    this.description_validation = error.response.data.errors.description[0]
                }
            })
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
            .catch((error)=>{
                this.images_validation = ''

                if(error.response.data.errors.images) {
                    this.images_validation = error.response.data.errors.images[0]
                }
            })
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
        async saveProduct() {
            await axios.post('/api/products/', {
                name: this.name,
                category: this.category,
                description: this.description,
                date_and_time: this.date_and_time,
            })
            .then((response) => {
                console.log(response)
                document.location.href="/products"
            })
            .catch(error => console.log(error))
        }
    }
}
</script>
<style scoped>
    
</style>