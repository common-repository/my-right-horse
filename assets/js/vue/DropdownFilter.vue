<template>
  <div :class="dropdownClass">
    <label for="breed-dropdown">{{ label }}</label>
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
        <li>
          <a href="#" @click.prevent="handleClick(-1)">{{ labelAll }}</a>
        </li>
        <li v-for="(item,i) in items" :key="i">
          <a href="#" @click.prevent="handleClick(i)" v-html="item"></a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    filterType: {
      type: String
    },
    dropdownClass: {
      type: String,
      default: "col-4",
    },
    label: {
      type: String,
      default: "Breed",
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
      return this.selectedOption >= 0
        ? this.items[this.selectedOption]
        : this.labelAll;
    },
  },
  methods: {
    handleClick(i) {
      this.selectedOption = i;
      let curCategory =
        i === -1 ? this.labelAll.toLowerCase() : this.items[i];
      this.$emit("chooseFilter", curCategory, this.filterType);
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
