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
          <v-card>
              <div v-for="(o,index) in data.variation.color" :key="index" >
                  <div  >
                      {{o.name}}
                  </div>
              </div>
              {{data.variation}}
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