<template>
  <v-row align="center">
    <v-col cols="6">
    <v-select
        :items="options"
        :menu-props="{ top: true, offsetY: true }"
        label="option"
        item-text="name"
        item-value="id"
    ></v-select>
    </v-col>
    <v-col cols="6">
    <v-combobox
        v-model="name"
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
</template>

<script>
export default {
    name:'Options',
    data(){
        return{
            dialog: false,
            options:{},
            items: ['size', 'color']
        }
    },
    created () {
      this.initialize()       
    },

    methods: {
      initialize () {
        this.axios
                .get('http://localhost:8000/api/options')
                .then(response => {
                    this.options = response.data;
                });
      },
    }
}
</script>

<style>

</style>