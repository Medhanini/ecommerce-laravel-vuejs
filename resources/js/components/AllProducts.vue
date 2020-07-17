<template>
<div>
  <v-data-table
    :headers="headers"
    :items="products.data"
    sort-by="title"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>My Products</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        
      </v-toolbar>
    </template>
     <template v-slot:item.actions="{ item }">
      <EditProducts :data="item" />
      <v-icon
        small
        @click="deleteItem(item.id)"
      >
        mdi-delete
      </v-icon>
      <ShowProduct :data="item" />
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
  <addProducts  :method="initialize" />
</div>
</template>


<script>
import addProducts from './AddProducts'
import EditProducts from './EditProducts'
import ShowProduct from './ShowProduct'
  export default {
    name:'AllProducts',
    components:{
      addProducts,
      EditProducts,
      ShowProduct
    },
    data: () => ({
      dialog: false,
      products: [],
      headers: [
        {
          text: '#id',
          align: 'start',
          value: 'id',
        },
        {
          text: 'title',
          sortable: false,
          value: 'title',
        },
        { text: 'Price', value: 'price' },
        { text: 'Qt', value: 'quantity' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      editedIndex: -1,
      editedItem: {
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },
    created () {
      this.initialize()       
    },

    methods: {
      initialize () {
        this.axios
                .get('http://localhost:8000/api/products')
                .then(response => {
                    this.products = response.data;
                });
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        confirm('Are you sure you want to delete this item?') && this.axios
                    .delete(`http://localhost:8000/api/products/delete/${item}`)
                    .then(response => {
                        let i = this.products.map(item => item.id).indexOf(id); // find index of your object
                        this.products.splice(i, 1)
                    });
                     this.initialize()  
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      addProducts () {
        this.axios
                    .post('http://localhost:8000/api/products/add', this.editedItem)
                    .then(response => (
                        this.$router.push({name: 'products'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
        this.close()
      },
    },
  }
</script>