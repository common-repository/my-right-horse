<template>
  <div :class="listingSearchClass">
    <label for="search">{{ label }}</label>
    <div class="search-horses">
        <div class="input-group">

          <input id="SearchApts" placeholder="Search" type="text" class="mrh-form-control mb-t2" aria-label="Search Horses" v-model="searchTerm" />

        </div><!-- input-group -->
    </div><!-- search-horses -->
  </div>
</template>

<script>
export default {
  name: "SearchAnimals",
  data() {
    return {
      searchTerm: "",
    };
  },
  props: {
    listingSearchClass: {
      type: String,
      default: "col-4",
    },
    label: {
      type: String,
      default: "Search by Name",
    },
  },
  watch: {
    searchTerm: function() {
      this.$emit("searchRecords", this.searchTerm);
    }, // searchTerm
  }, // watch
}; // export
</script>
