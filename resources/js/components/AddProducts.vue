<template>
    <v-dialog v-model="dialog" max-width="1000px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
            bottom
            color="primary"
            dark
            fab
            fixed
            right
            v-bind="attrs"
              v-on="on"
          >
            <v-icon>mdi-plus</v-icon>
          </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline"> Add Product </span>
            </v-card-title>

                
            <v-card-text>
              <v-container>
                  <v-form
                  ref="form"
                  v-model="valid"
                  lazy-validation
                >
                <v-row>
                  <v-col cols="12" >
                    <v-text-field v-model="product.title" required label="Title"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field v-model="product.price" required label="Price"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field v-model="product.quantity" required label="Quantity"></v-text-field>
                  </v-col>
                  <v-divider></v-divider>
                  <v-col cols="12">
                    <v-row align="center">
    <v-col cols="6">
    <v-select
        v-model="product.product_variation_types_id"
        :items="options"
        :menu-props="{ top: true, offsetY: true }"
        label="option"
        item-text="name"
        item-value="id"
    ></v-select>
    </v-col>
    <v-col cols="6">
    <v-combobox
        v-model="product.name"
        label="separate options witha comma"
        multiple
        chips
    >
        <template v-slot:selection="data">
        <v-chip
            :key="JSON.stringify(data.item)"
            v-bind="data.attrs"
            :input-value="data.selected"
            :disabled="data.disabled"
            @click:close="data.parent.selectItem(data.item)"
        >
            <v-avatar
            class="accent white--text"
            left
            v-text="data.item.slice(0, 1).toUpperCase()"
            ></v-avatar>
            {{ data.item }}
        </v-chip>
        </template>
    </v-combobox>
    </v-col>
</v-row>
                  </v-col>
                </v-row>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text 
              :disabled="!valid"
              class="mr-4"
               @click="addProducts"
              >Save</v-btn>
            </v-card-actions>
            </v-form>
            {{ product }}
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>
</template>
<script>
import Options from './Options'
export default {
    name:'AddProduct',
    components:{
      Options
    },
    props: {
    method: { type: Function },
  },
    data(){
        return{
            dialog: false,
            product:{},
            options:{}
        }
    },
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },
    watch: {
      dialog (val) {
        val || this.close()
      },
    },
    created () {
      this.initialize()       
    },

    methods: {
      initialize () {
              this.axios
                      .get('http://127.0.0.1:8000/api/variationstypes')
                      .then(response => {
                          this.options = response.data;
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
                    .post('http://localhost:8000/api/products/add', this.product)
                    .then(response => (
                        this.$router.push({name: 'products'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
        this.close()
        this.method()
      },
    },
}
</script>