<template>
  <div :class="dropdownClass">
    <label for="gender-dropdown" class="sort-label">{{ label }}</label>
    <div class="mrh-dropdown">
      <button 
        class="btn mrh-dropdown-toggle" 
        type="button"
        :aria-expanded="visible ? 'true' : 'false'"
        v-html="selectedValue"
        @click.prevent="dropMeDown"
        v-click-outside="closeDropdown">
      </button>
      <ul class="mrh-dropdown-menu" v-if="visible">
        <li v-for="(item,i) in items" :key="i">
          <a href="#" @click.prevent="requestSortChange(item.prop, item.dir, i)" v-html="item.label"></a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    dropdownClass: {
      type: String,
      default: "col-4",
    },
    label: {
      type: String,
      default: "Sort By",
    },
    labelAll: {
      type: String,
      default: "All",
    },
    items: {
      type: Array,
      required: true,
    },
  },
  data: function() {
    return {
      visible: false,
      selectedOption: {
        type: Number,
        default: null,
      },
    };
  },
  computed: {
    selectedValue: function() {
      let selOption = this.selectedOption;
      if( selOption == 0 ) {
        return "Date Added (Asc)";
      }
      if( selOption == 1 ) {
        return "Date Added (Desc)";
      }
      if( selOption == 2 ) {
        return "Height (Asc)";
      }
      if( selOption == 3 ) {
        return "Height (Desc)";
      }
      if( selOption == 4 ) {
        return "Age (Asc)";
      }
      if( selOption == 5 ) {
        return "Age (Desc)";
      }
      return this.labelAll;
    },
  },
  methods: {
    requestSortChange(key,order, pos) {
      this.selectedOption = pos;
      this.$emit('sortChange', key, order);
    },
    dropMeDown () {
      this.visible = !this.visible;
    },
    closeDropdown () {
      this.visible = false;
    },
  },
};
</script>
