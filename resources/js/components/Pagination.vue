<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="pagination-item">
                <button type="button" @click="firstPage"> &laquo; </button>
            </li>
            <li class="pagination-item">
                <button type="button" @click="backPage">&lsaquo;</button>
            </li>
            <li class="pagination-item" 
                v-for="page in this.totalPages"
                :key="page">
                <button
                type="button" 
                :class="{ active: isPageActive(page) }" @click="() => goToPage(page)"
                >
                {{ page }}
                </button>
            </li>
            <li class="pagination-item">
                <button type="button" @click="nextPage">&rsaquo;</button>
            </li>
            <li class="pagination-item">
                <button type="button" @click="lastPage">&raquo;</button>
            </li>
        </ul>
    </nav>
</template>

<script>

export default {

props: {
        products:{
            type:Array,
            required:true,
        },

        currentPage:{
            type: Number,
            required:true,
        }, 

        pageSize:{
            type:Number,
            required:true,
        },

        totalPages:{
            type:Number,
            required:true,
        }
        },


  methods:{
        nextPage() {
        this.$emit('pagechange', this.currentPage + 1)
        },
        
        backPage(){
            this.$emit('pagechange', this.currentPage - 1)
        },
        
        goToPage(numPage){
            this.$emit('pagechange', numPage)
        },
            firstPage(){
                if (this.currentPage !== 1) {
                    this.$emit('pagechange', 1)
                }
            },

        backPage(){
            if (this.currentPage !== 1) {
                this.$emit('pagechange', this.currentPage - 1)
            }
        },

        nextPage() {
            if (this.currentPage !== this.totalPages) {
                this.$emit('pagechange', this.currentPage + 1)
            }
        },
      
        goToPage(numPage){
            this.$emit('pagechange', numPage)
        },

        lastPage() {
            if (this.currentPage !== this.totalPages) {
                let lastPage = this.totalPages;
                this.$emit('pagechange', lastPage)
            }
        },
        
        isPageActive(page){
            return this.currentPage === page;
        },
  } ,


}
</script>
<style scoped>
nav {
  float: right;
}

.pagination {
  list-style: none;
  
  padding: 0;
  margin-top: 10px;
}

.pagination li {
  display: inline;
  text-align: center;
}

.pagination button {
  float: left;
  display: block;
  font-size: 14px;
  text-decoration: none;
  padding: 5px 12px;
  color: #fff;
  margin-left: -1px;
  border: 1px solid transparent;
  line-height: 1.5;
  border-radius: 60px;
  
}

.pagination button.active {
  cursor: default;
}
.pagination button:active {
  outline: none;
}

.pagination button {
  border-color: #ddd;
  color: #007bff;
  background: #fff;
}

.pagination button:hover {
  border-color: #007bff;
  background: #007bff;
  color: #fff;
}

.pagination button.active, button:active {
  border-color: #007bff;
  background: #007bff;
  color: #fff;
}
</style>