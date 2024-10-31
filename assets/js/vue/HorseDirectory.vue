<template>
  <div class="horse-directory">
    <div class="mrh-container">
      <div class="row">
        <div :class="cardDisplay" v-for="(animal,index) in animals" :key="index">
          <div class="mrh-card">
            <div class="mrh-card-body">
              <div
                :style="{
                              backgroundImage: 'url(' + animal.cover + ')',
                            }"
                class="listing-card-image"
              >
                <a
                  :href="cardURL(animal.slug)"
                  class="prevent-outclick"
                  @click="triggerCardLink(animal, $event)"
                ></a>
              </div>
              <h5 class="card-title" v-if="displayName">{{ animal.name }}</h5>
              <p
                class="listing-data location"
              >{{ animal.location.city }}, {{ animal.location.state }}</p>
              <p class="listing-data listing-props" v-html="displayProps(animal)"></p>

              <div class="card-buttons-wrapper">
                <a
                  :href="contactEmail"
                  :class="buttonClass"
                  :style="buttonStyle"
                  @click="triggerContactLink(animal, $event)"
                >{{ contactButtonLabel }}</a>
                <a
                  :href="cardURL(animal.slug)"
                  :class="buttonClass"
                  :style="buttonStyle"
                  @click="triggerCardLink(animal, $event)"
                >{{ detailButtonLabel }}</a>
              </div>
            </div>
            <!-- .card-body -->
          </div>
        </div>
      </div>
      <!-- .row -->
    </div>
  </div>
  <!-- .horse-directory -->
</template>

<script>
export default {
  name: "HorseDirectory",
  props: {
    animals: Array,
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
    detailButtonLabel: {
      type: String,
      default: "Email Us"
    },
    enableContactFormModal: {
      type: Boolean,
      default: true
    },
    enableLightbox: {
      type: Boolean,
      default: true
    },
    informationDisplayed: {
      type: Array
    },
    numberOfColumns: {
      type: Number,
      default: 2
    }
  },
  computed: {
    cardDisplay() {
      return `mrh-column col-md-${12 / this.numberOfColumns}`;
    },
    displayName() {
      return this.informationDisplayed.includes("name");
    },
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
    }
  },
  methods: {
    cardURL(url) {
      if (!this.enableLightbox) {
        return `https://${!!mrhServer ? mrhServer : 'www.myrighthorse.org'}/available-horses/` + url;
      }
      return "#";
    },
    triggerCardLink(animal, event) {
      event.preventDefault();
      let self = this;
      if (this.enableLightbox) {
        self.displayModal(animal);
      } else {
        window.open(
          `https://${!!mrhServer ? mrhServer : 'www.myrighthorse.org'}/available-horses/` + animal.slug,
          "_blank"
        );
      }
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
    displayProps(animal) {
      let propsToDisplay = [];
      let propsAvailable = ["breed", "gender", "age", "height"];
      let self = this;
      propsAvailable.forEach(function(el) {
        if (self.informationDisplayed.includes(el)) {
          let animalProp = animal[el];
          if (animalProp !== undefined) {
            if (el == "age") {
              animalProp = animalProp + " years";
            }
            if (el == "height") {
              animalProp = animalProp + " HH";
            }
            propsToDisplay.push(animalProp);
          }
        }
      });
      return propsToDisplay.join(" / ");
    },
    displayModal(animal) {
      this.$emit("triggerModal", animal);
    },
    displayContactFormModal(animal) {
      this.$emit("triggerContactFormModal", animal);
    }
  }
};
</script>
