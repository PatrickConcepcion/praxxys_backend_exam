<template>
    <div class="container">
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
                    <div class="form-group m5-3">
                        <label>Description</label>
                        <textarea class="form-control" v-model="description"></textarea>
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
    </div>
</template>
<script>
export default {
    name: 'Create Products',
    data() {
        return {
            firstStep: false,
            secondStep: true,
            thirdStep: false,
            images: [],
            name: '',
            category: '',
            description: '',
        }
    },
    methods: {
        upload(e){
            // var files = e.target.files || e.dataTransfer.files;
            // if (!files.length) return;
            // this.createImage(files);
            this.images = e.target.files;

            console.log(this.images);
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
        }
    }
}
</script>
<style scoped>
    
</style>