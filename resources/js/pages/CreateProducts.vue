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
                <form @submit.prevent="">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" v-model="name">
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
            firstStep: true,
            secondStep: false,
            thirdStep: false,
            name: '',
            category: '',
            description: '',
        }
    },
    methods: {
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
        }
    }
}
</script>
<style scoped>
    
</style>