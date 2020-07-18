<template>
    <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
          <v-icon
            small
            class="mr-2"
            v-bind="attrs"
            v-on="on"
        >
            mdi-eye
        </v-icon>
          </template>
  <v-card
    class="mx-auto"
    color="#26c6da"
    dark
  >
    <v-card-title>
      <v-icon
        large
        left
      >
        mdi-information-variant
      </v-icon>
      <span class="title font-weight-light"> {{ data.title }} </span>
    </v-card-title>

    <v-card-text class="headline font-weight-bold">
  <v-card
    class="mx-auto"
  >
    <v-list>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title > Price : </v-list-item-title>
        </v-list-item-content>

        <v-list-item-avatar>
          {{ data.price }}
        </v-list-item-avatar>
      </v-list-item>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title > Quantity : </v-list-item-title>
        </v-list-item-content>

        <v-list-item-avatar>
          {{ data.quantity }}
        </v-list-item-avatar>
      </v-list-item>
    </v-list>
  </v-card>
    </v-card-text>

    <v-card-actions>
      <v-simple-table dense>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Name</th>
              <th class="text-left">Price</th>
              <th class="text-left">Quantity</th>
              <th class="text-left">Type</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(value, index) in data.variation" :key="index">
              <td>{{ value.name }}</td>
              <td>{{ value.price }}</td>
              <td>{{ value.quantity }}</td>
              <td>{{ value.type.name }}</td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-card-actions>
  </v-card>
        </v-dialog>
</template>
<script>
export default {
    name:'EditProducts',
    props: {
    method: { type: Function },
    data:{
        type:Object
    }
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
    },created () {
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
      }
    },
}
</script>