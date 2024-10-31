<template>
  <div :class="selectedTheme">
    <div class="filter-wrap" v-if="!loading && !errors">
      <div class="container">
        <div class="row filters-container">
          <listing-search
            listing-search-class="listing-search mrh-filter filter-column"
            label="Search by Name"
            @searchRecords="searchAnimals"
            v-if="filterByName"
          />

          <dropdown-filter
            filter-type="gender"
            :items="genders"
            label="Gender"
            :label-all="genderLabelAll"
            dropdown-class="mrh-filter filter-column"
            @chooseFilter="onChooseFilter"
            v-if="filterByGender"
          />

          <dropdown-filter
            filter-type="breed"
            :items="breeds"
            label="Breed"
            :label-all="breedLabelAll"
            dropdown-class="mrh-filter filter-column"
            @chooseFilter="onChooseFilter"
            v-if="filterByBreed"
          />

          <div class="multi-range-input-wrapper mrh-filter filter-column" v-if="filterByAge">
            <label for="age">Age Range</label>

            <div class="selected-range">{{ visualMinAge }} to {{ visualMaxAge }} years</div>

            <multi-range-input
              element-class="mrh-filter"
              :min-value="minAge"
              :max-value="maxAge"
              :selected-min-value.sync="selectedMinAge"
              :selected-max-value.sync="selectedMaxAge"
              :step="1"
            ></multi-range-input>
          </div>

          <sort-filter
            label="Sort"
            :items="sortOptions"
            label-all="Date Added (Desc)"
            dropdown-class="mrh-filter"
            @sortChange="updateSort"
          />
        </div>
        <!-- .row -->
      </div>
      <!-- .container -->
    </div>
    <!-- .filter-wrap -->

    <horse-directory
      :animals="displayedAnimals"
      :number-of-columns="numberOfColumns"
      :information-displayed="informationDisplayed"
      :button-types="buttonTypes"
      :button-color="buttonColor"
      :contact-button-label="contactButtonLabel"
      :contact-email-address="contactEmailAddress"
      :detail-button-label="detailButtonLabel"
      :enable-lightbox="enableLightbox"
      :enable-contact-form-modal="enableContactFormModal"
      :enable-filtering="enableFiltering"
      :enable-name-search="enableNameSearch"
      :oldest-first="oldestFirst"
      @triggerModal="displayModal"
      @triggerContactFormModal="displayContactFormModal"
    />

    <div
      class="alert alert-danger"
      role="alert"
      v-if="errors"
    >Data could not be displayed. Please verify the API key is correct.</div>

    <div class="pagination-wrap" v-if="showPagination && !errors">
      <div class="container">
        <div class="row">
          <div class="clearfix btn-group col-md-2">
            <span>Results {{ resultsFrom }} - {{ resultsTo }} of {{ searchedAnimals.length }}</span>
          </div>
          <div class="clearfix btn-group col-md-4">
            <button
              type="button"
              class="btn btn-sm btn-outline-secondary"
              :disabled="page === 1"
              @click="page--"
            >&laquo;</button>
            <button
              type="button"
              @click="page++"
              :disabled="page === numberOfPages"
              class="btn btn-sm btn-outline-secondary"
            >&raquo;</button>
          </div>
        </div>
        <!-- .row -->
      </div>
      <!-- .container -->
    </div>
    <!-- .pagination-wrap -->

    <detail-modal
      v-if="showModal"
      :horse="currentHorse"
      :button-types="buttonTypes"
      :button-color="buttonColor"
      :contact-button-label="contactButtonLabel"
      :contact-email-address="contactEmailAddress"
      :enable-contact-form-modal="enableContactFormModal"
      @triggerContactFormModal="showContactFormModalFromDetail"
      @closeModal="showModal=false"
    />

    <contact-form-modal
      v-if="showContactFormModal"
      :information-displayed="informationDisplayed"
      :horse="currentHorse"
      :button-types="buttonTypes"
      :button-color="buttonColor"
      :contact-button-label="contactButtonLabel"
      :contact-email-address="contactEmailAddress"
      @closeModal="showContactFormModal=false"
    />
  </div>
</template>

<script>
import HorseDirectory from "./HorseDirectory.vue";
import DropdownFilter from "./DropdownFilter.vue";
import ListingSearch from "./ListingSearch.vue";
import MultiRangeInput from "./MultiRangeInput.vue";
import SortFilter from "./SortFilter.vue";
import DetailModal from "./DetailModal.vue";
import ContactFormModal from "./ContactFormModal.vue";
import $ from 'jquery';

const baseURL = "/wp-json/mrh/horses/";

export default {
  name: "MainApp",
  components: {
    "horse-directory": HorseDirectory,
    "dropdown-filter": DropdownFilter,
    "listing-search": ListingSearch,
    "multi-range-input": MultiRangeInput,
    "sort-filter": SortFilter,
    "detail-modal": DetailModal,
    "contact-form-modal": ContactFormModal
  },
  data() {
    return {
      animals: [],
      breeds: [],
      breedLabelAll: "All breeds",
      chosenBreed: "",
      genders: [],
      genderLabelAll: "All genders",
      chosenGender: "",

      loading: true,
      errors: false,

      // Extra Settings
      numberOfPages: 1,
      page: 1,

      // Theme Settings
      numberOfColumns: 2,
      perPage: 9,
      enablePagination: true,
      theme: "light-theme",
      informationDisplayed: [],
      buttonTypes: "solid-semi-circular",
      buttonColor: "rgb(231, 126, 59)",
      contactButtonLabel: "Email Us",
      contactEmailAddress: "",
      detailButtonLabel: "Listing Detail",
      enableContactFormModal: true,
      enableLightbox: true,
      enableFiltering: true,
      enableNameSearch: true,
      oldestFirst: true,
      filters: [],

      // Custom Components settings
      searchFormClass: "col-4",
      searchTerms: "",
      selectedMinAge: 1,
      selectedMaxAge: 18,
      sortOptions: [
        { prop: "created_at", dir: "asc", label: "Date Added (Asc)" },
        { prop: "created_at", dir: "desc", label: "Date Added (Desc)" },
        { prop: "height", dir: "asc", label: "Height (Asc)" },
        { prop: "height", dir: "desc", label: "Height (Desc)" },
        { prop: "age", dir: "asc", label: "Age (Asc)" },
        { prop: "age", dir: "desc", label: "Age (Desc)" }
      ],
      // Defaults
      filterKey: "created_at",
      filterDir: "desc",

      // Modal settings
      showModal: false,
      showContactFormModal: false,
      currentHorse: {}
    };
  },

  methods: {
    getAnimals(callback) {
      let self = this;
      axios
        .get(baseURL)
        .then(response => {
          this.animals = response.data;
          this.loading = false;
          // console.log(this.animals);
          if (this.animals.hasOwnProperty("error")) {
            this.errors = true;
          } else {
            this.getGenders();
            this.getBreeds();
            this.selectedMinAge = Math.min.apply(
              Math,
              this.animals.map(function(o) {
                return o.age;
              })
            );
            this.selectedMaxAge = Math.max.apply(
              Math,
              this.animals.map(function(o) {
                return o.age;
              })
            );
          }
        })
        .catch(response => {
          console.log(response);
        });
    },
    getGenders() {
      let animalList = this.animals;
      this.genders = [...new Set(animalList.map(a => a.gender))];
      this.genders.sort((a, b) => a.localeCompare(b));
    },
    getBreeds() {
      let animalList = this.animals;
      this.breeds = [...new Set(animalList.map(a => a.breed))];
      this.breeds.sort((a, b) => a.localeCompare(b));
    },
    // Set the number of pages based on the length of
    // the results array.
    setNumberofPages() {
      this.numberOfPages = Math.ceil(
        this.searchedAnimals.length / this.perPage
      );
    },

    // This method is called when the dropdown filter is called
    onChooseFilter(value, type) {
      this.page = 1;
      if (type == "gender") {
        this.chosenGender = value;
      } else if (type == "breed") {
        this.chosenBreed = value;
      }
      this.setNumberofPages();
    },

    // Called when typing the search form
    searchAnimals: function(terms) {
      this.page = 1;
      this.searchTerms = terms;
      this.setNumberofPages();
    },

    // Called when sort dropdown is clicked
    updateSort(key, order) {
      this.filterKey = key;
      this.filterDir = order;
    },

    // Receive the whole collection, check for Page and return a sliced array
    paginate(animals) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return animals.slice(from, to);
    },

    displayModal(animal) {
      this.showModal = true;
      this.currentHorse = animal;
    },
    displayContactFormModal(animal) {
      this.showContactFormModal = true;
      this.currentHorse = animal;
    },

    showContactFormModalFromDetail() {
      this.showModal = false;
      this.showContactFormModal = true;
    },

    escapeKeyListener(evt) {
      if (evt.keyCode === 27 && this.showModal) {
        this.showModal = false;
      }
      if (evt.keyCode === 27 && this.showContactFormModal) {
        this.showContactFormModal = false;
      }
    }
  },

  computed: {
    // The whole collection
    searchedAnimals: function() {
      let allAnimals = this.animals;
      let vm = this;

      if (allAnimals.error) {
        return false;
      }

      if (
        this.chosenGender.toLowerCase() !== this.genderLabelAll.toLowerCase()
      ) {
        allAnimals = allAnimals.filter(
          function(animal) {
            return animal.gender.indexOf(this.chosenGender) >= 0;
          }.bind(this)
        );
      }

      if (this.chosenBreed.toLowerCase() !== this.breedLabelAll.toLowerCase()) {
        allAnimals = allAnimals.filter(
          function(animal) {
            return animal.breed.indexOf(this.chosenBreed) >= 0;
          }.bind(this)
        );
      }

      allAnimals = allAnimals.filter(animal => {
        return (
          vm.selectedMinAge <= animal.age && vm.selectedMaxAge >= animal.age
        );
      });

      return allAnimals.filter(
        function(animal) {
          return animal.name
            .toLowerCase()
            .match(this.searchTerms.toLowerCase());
        }.bind(this)
      );
    },

    selectedTheme() {
      return "mrh-" + this.theme;
    },

    // Prop looks for sort dropdown values
    filteredAnimals: function() {
      return _.orderBy(
        this.searchedAnimals,
        function(item) {
          if (typeof item[this.filterKey] == "string") {
            return item[this.filterKey].toLowerCase();
          } else {
            return item[this.filterKey];
          }
        }.bind(this),
        this.filterDir
      );
    },

    // Only the ones displayed (for example: page 2)
    displayedAnimals() {
      return this.paginate(this.filteredAnimals);
    },

    // Pagination computed props
    resultsFrom() {
      if (this.searchedAnimals.length == 0) {
        return 0;
      }
      return (this.page - 1) * this.perPage + 1;
    },
    resultsTo() {
      return Math.min(
        this.resultsFrom + this.perPage - 1,
        this.searchedAnimals.length
      );
    },
    showPagination() {
      return !this.loading && this.enablePagination;
    },

    // Age Computed props
    minAge() {
      let data = this.animals;
      return data.reduce((min, b) => Math.min(min, b.age), data[0].age);
    },
    maxAge() {
      let data = this.animals;
      return data.reduce((max, b) => Math.max(max, b.age), data[0].age);
    },
    visualMinAge() {
      return this.selectedMinAge < this.selectedMaxAge
        ? this.selectedMinAge
        : this.selectedMaxAge;
    },
    visualMaxAge() {
      return this.selectedMinAge > this.selectedMaxAge
        ? this.selectedMinAge
        : this.selectedMaxAge;
    },

    // Choose Filters
    filterByName() {
      return this.enableNameSearch;
    },

    filterByBreed() {
      return this.filters.includes("breed") && this.enableFiltering;
    },

    filterByGender() {
      return this.filters.includes("gender") && this.enableFiltering;
    },

    filterByAge() {
      return this.filters.includes("age") && this.enableFiltering;
    }
  },

  created() {
    this.chosenBreed = this.breedLabelAll;
    this.chosenGender = this.genderLabelAll;
    this.getAnimals();
    document.addEventListener("keyup", this.escapeKeyListener);
  }, //created

  mounted() {
    let parentEl = $(".mrh-wrapper");
    this.numberOfColumns = parentEl.data("number-of-columns");
    this.enablePagination = parentEl.data("enable-pagination");
    this.perPage = this.enablePagination ? parentEl.data("per-page") : 100;
    this.theme = parentEl.data("theme");
    this.informationDisplayed = parentEl.data("information-displayed");
    this.buttonTypes = parentEl.data("button-types");
    this.buttonColor = parentEl.data("button-color");
    this.contactButtonLabel = parentEl.data("contact-button-label");
    this.contactEmailAddress = parentEl.data("contact-email-address");
    this.detailButtonLabel = parentEl.data("detail-button-label");
    this.enableLightbox = parentEl.data("enable-lightbox");
    this.enableContactFormModal = parentEl.data("enable-contact-form-modal");
    this.enableFiltering = parentEl.data("enable-filtering");
    this.filters = parentEl.data("filters");
    this.enableNameSearch = parentEl.data("enable-name-search");
    this.oldestFirst = parentEl.data("oldest-first");
  },

  destroy() {
    document.removeEventListener("keyup", this.escapeKeyListener);
  },

  watch: {
    animals() {
      this.setNumberofPages();
    },
    chosenBreed(newVal, oldVal) {
      if (newVal != oldVal) {
        this.setNumberofPages();
      }
    },
    chosenGender(newVal, oldVal) {
      if (newVal != oldVal) {
        this.setNumberofPages();
      }
    },
    page(newVal, oldVal) {
      if (newVal != oldVal) {
        // var self = this;
        this.getAnimals(function() {
          window.preventNavDown = true;
        });
      }
    },
    selectedMinAge(newVal, oldVal) {
      if (newVal != oldVal) {
        this.page = 1;
        this.setNumberofPages();
      }
    },
    selectedMaxAge(newVal, oldVal) {
      if (newVal != oldVal) {
        this.page = 1;
        this.setNumberofPages();
      }
    },
    showModal() {
      var className = "modal-open";
      if (this.showModal) {
        document.body.classList.add(className);
      } else {
        document.body.classList.remove(className);
      }
    },
    showContactFormModal() {
      var className = "modal-open";
      if (this.showContactFormModal) {
        document.body.classList.add(className);
      } else {
        document.body.classList.remove(className);
      }
    }
  }
};
</script>
