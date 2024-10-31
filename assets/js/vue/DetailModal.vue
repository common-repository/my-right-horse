<template>
  <div class="modal-mask">
    <div class="modal-dialog" role="document">
      <div class="modal-content" v-click-outside="closeModal">
        <button
          type="button"
          class="mrh-close"
          data-dismiss="modal"
          aria-label="Close"
          @click="closeModal"
        >
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-header">
          <img :src="horse.cover" class="mrh-img-fluid" alt />
        </div>
        <div class="mrh-modal-body">
          <h4>Adoption Overview</h4>
          <p class="mrh-description" v-html="horse.description"></p>

          <h4>Details</h4>
          <table class="table">
            <tbody>
              <tr v-if="horse.name">
                <td>
                  <strong>Name</strong>
                </td>
                <td>{{ horse.name }}</td>
              </tr>
              <tr v-if="horse.location">
                <td>
                  <strong>Location</strong>
                </td>
                <td>{{ horse.location.city }}, {{ horse.location.state }}</td>
              </tr>
              <tr v-if="horse.breed">
                <td>
                  <strong>Breed</strong>
                </td>
                <td>{{ horse.breed }}</td>
              </tr>
              <tr v-if="horse.gender">
                <td>
                  <strong>Gender</strong>
                </td>
                <td>{{ horse.gender }}</td>
              </tr>
              <tr v-if="horse.age">
                <td>
                  <strong>Age</strong>
                </td>
                <td>{{ horse.age }} Years</td>
              </tr>
              <tr v-if="horse.height">
                <td>
                  <strong>Height</strong>
                </td>
                <td>{{ horse.height }} HH</td>
              </tr>
              <tr v-if="horse.color">
                <td>
                  <strong>Color</strong>
                </td>
                <td>{{ horse.color }}</td>
              </tr>
              <tr v-if="horse.disciplines">
                <td>
                  <strong>Disciplines</strong>
                </td>
                <td>{{ disciplines }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- .modal-body -->

        <div class="mrh-modal-footer">
          <a href="#" :class="buttonClass" :style="buttonStyle" @click="closeModal">Close</a>
          <a
            :href="contactEmail"
            :class="buttonClass"
            :style="buttonStyle"
            @click="triggerContactLink(horse, $event)"
          >Contact Us</a>
        </div>
        <!-- .modal-footer -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ListingModal",
  props: {
    horse: {
      type: Object
    },
    buttonColor: {
      type: String,
      default: "rgba(231, 126, 59, 1)"
    },
    buttonTypes: {
      type: String,
      default: "solid-semi-circular"
    },
    contactButtonLabel: {
      type: String,
      default: "Contact Us"
    },
    contactEmailAddress: {
      type: String
    },
    enableContactFormModal: {
      type: Boolean,
      default: true
    }
  },
  methods: {
    closeModal() {
      this.$emit("closeModal");
    },
    triggerContactLink(animal, event) {
      let self = this;
      event.preventDefault();
      if (this.enableContactFormModal) {
        self.displayContactFormModal(animal);
      } else {
        window.open(event.target.href);
      }
    },
    displayContactFormModal(animal) {
      this.$emit("triggerContactFormModal", animal);
    }
  },
  computed: {
    buttonClass() {
      return (
        "mrh-btn prevent-outclick mrh-btn-secondary mrh-btn-" + this.buttonTypes
      );
    },
    buttonStyle() {
      if (this.buttonTypes.includes("solid")) {
        return "background-color: " + this.buttonColor;
      } else {
        return "border-color: " + this.buttonColor;
      }
    },
    contactEmail() {
      return "mailto:" + this.contactEmailAddress;
    },
    disciplines() {
      if (this.horse.disciplines) {
        return this.horse.disciplines.join(", ");
      }
      return false;
    }
  }
}; // export
</script>
