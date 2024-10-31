<template>
  <div class="modal-mask contact-form-modal">
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
          <h1>Contact Us</h1>
        </div>

        <div class="mrh-modal-body">
          <div class="row mt-5 contact-us">
            <div class="col-12">
              <h5>Details of the horse you are interested in.</h5>
            </div>

            <div class="horse-info">
              <div class="inquiry-image-container">
                <img class="inquiry-image" :src="horse.cover" />
              </div>
              <div class="horse-details">
                <h5>{{ horse.name }}</h5>
                <p class="inquiry-details listing-props" v-html="displayProps(horse)"></p>
                <div class="inquiry-details">{{ horse.location.city }}, {{ horse.location.state }}</div>
              </div>
            </div>
            <!-- .horse-info -->

            <div class="col-12 mt-3 mb-3">
              <h5>Tell us a little about yourself.</h5>
            </div>
          </div>
          <!-- .contact-us -->

          <form class="mrh-contact-form">
            <input name="utf8" type="hidden" value="✓" />

            <div class="form-row">
              <div class="form-group col-sm-6 pr-sm-2">
                <label for="mrh_first_name">First Name *</label>
                <input
                  class="form-control"
                  :class="{ 'required' : errors.first_name }"
                  placeholder="John"
                  type="text"
                  id="mrh_first_name"
                  style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"
                  v-model="form.first_name"
                />

                <span class="help is-danger" v-text="errors.first_name" v-if="errors.first_name"></span>
              </div>

              <div class="form-group col-sm-6 pl-sm-2">
                <label for="mrh_last_name">Last Name *</label>
                <input
                  class="form-control"
                  :class="{ 'required' : errors.last_name }"
                  placeholder="Smith"
                  type="text"
                  id="mrh_last_name"
                  v-model="form.last_name"
                />

                <span class="help is-danger" v-text="errors.last_name" v-if="errors.last_name"></span>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-6 pr-sm-2">
                <label for="mrh_contact_email">Email *</label>

                <input
                  class="form-control"
                  :class="{ 'required' : errors.contact_email }"
                  placeholder="person@place.com"
                  type="email"
                  id="mrh_contact_email"
                  v-model="form.contact_email"
                />

                <span
                  class="help is-danger"
                  v-text="errors.contact_email"
                  v-if="errors.contact_email"
                ></span>
              </div>

              <div class="form-group col-sm-6 pl-sm-2">
                <label for="mrh_contact_phone">Phone *</label>

                <input
                  class="form-control"
                  :class="{ 'required' : errors.contact_phone }"
                  placeholder="555-555-5555"
                  type="text"
                  id="mrh_contact_phone"
                  v-model="form.contact_phone"
                />

                <span
                  class="help is-danger"
                  v-text="errors.contact_phone"
                  v-if="errors.contact_phone"
                ></span>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-4">
                <label for="state_of_residence">Your current state of residence</label>

                <select
                  class="form-dropdown"
                  :class="{ 'required' : errors.state_of_residence }"
                  id="state_of_residence"
                  v-model="form.state_of_residence"
                >
                  <option value>Select a state *</option>
                  <option>AL</option>
                  <option>AK</option>
                  <option>AZ</option>
                  <option>AR</option>
                  <option>CA</option>
                  <option>CO</option>
                  <option>CT</option>
                  <option>DE</option>
                  <option>DC</option>
                  <option>FL</option>
                  <option>GA</option>
                  <option>HI</option>
                  <option>ID</option>
                  <option>IL</option>
                  <option>IN</option>
                  <option>IA</option>
                  <option>KS</option>
                  <option>KY</option>
                  <option>LA</option>
                  <option>ME</option>
                  <option>MD</option>
                  <option>MA</option>
                  <option>MI</option>
                  <option>MN</option>
                  <option>MS</option>
                  <option>MO</option>
                  <option>MT</option>
                  <option>NE</option>
                  <option>NV</option>
                  <option>NH</option>
                  <option>NJ</option>
                  <option>NM</option>
                  <option>NY</option>
                  <option>NC</option>
                  <option>ND</option>
                  <option>OH</option>
                  <option>OK</option>
                  <option>OR</option>
                  <option>PA</option>
                  <option>PR</option>
                  <option>RI</option>
                  <option>SC</option>
                  <option>SD</option>
                  <option>TN</option>
                  <option>TX</option>
                  <option>UT</option>
                  <option>VT</option>
                  <option>VA</option>
                  <option>WA</option>
                  <option>WV</option>
                  <option>WI</option>
                  <option>WY</option>
                </select>

                <span
                  class="help is-danger"
                  v-text="errors.state_of_residence"
                  v-if="errors.state_of_residence"
                ></span>
              </div>

              <div class="form-group col-sm-4">
                <label for="contact_method">Preferred contact method?</label>
                <select class="form-dropdown" id="contact_method" v-model="form.contact_method">
                  <option value>Select a contact method</option>
                  <option>Phone</option>
                  <option>Email</option>
                </select>
              </div>

              <div class="form-group col-sm-4">
                <label for="age">Are you over 18 years old? *</label>
                <select
                  class="form-dropdown"
                  :class="{ 'required' : errors.age }"
                  id="age"
                  v-model="form.age"
                >
                  <option value>Select one</option>
                  <option>Yes</option>
                  <option>No</option>
                </select>

                <span class="help is-danger" v-text="errors.age" v-if="errors.age"></span>
              </div>
            </div>

            <div class="mt-3 mb-3">
              <h5>Share your equine experience with us.</h5>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="horse_owner">Are you currently a horse owner? *</label>

                <select
                  class="form-dropdown"
                  :class="{ 'required' : errors.horse_owner }"
                  id="horse_owner"
                  v-model="form.horse_owner"
                >
                  <option value>Select one</option>
                  <option>Yes</option>
                  <option>No</option>
                </select>

                <span class="help is-danger" v-text="errors.horse_owner" v-if="errors.horse_owner"></span>
              </div>

              <div class="form-group col-sm-6">
                <label for="adoption_time_frame">What is your time frame for adoption? *</label>

                <select
                  class="form-dropdown"
                  :class="{ 'required' : errors.adoption_time_frame }"
                  id="adoption_time_frame"
                  v-model="form.adoption_time_frame"
                >
                  <option value>Select a timeframe</option>
                  <option>As soon as possible</option>
                  <option>1 month</option>
                  <option>3 months</option>
                  <option>6 months</option>
                  <option>Within a year</option>
                </select>

                <span
                  class="help is-danger"
                  v-text="errors.adoption_time_frame"
                  v-if="errors.adoption_time_frame"
                ></span>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="horse_type">What type of horse are you looking for?</label>

                <select class="form-dropdown" id="horse_type" v-model="form.horse_type">
                  <option value>Select one</option>
                  <option>Suitable for beginner rider/handler</option>
                  <option>Suitable for intermediate rider/handler</option>
                  <option>Suitable for advanced rider/handler</option>
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label for="stabling_location">Where do you intend on stabling your adopted horse?</label>

                <input
                  class="form-control"
                  placeholder="Tell us more"
                  type="text"
                  id="stabling_location"
                  v-model="form.stabling_location"
                />
              </div>
            </div>

            <div class="form-group">
              <label for="questions_comments">Questions / Comments</label>

              <textarea
                rows="4"
                class="form-control"
                placeholder="I have a question..."
                id="questions_comments"
                v-model="form.questions_comments"
              ></textarea>
            </div>

            <div class="row">
              <div class="col-12 d-flex justify-content-center">
                <input
                  type="submit"
                  name="commit"
                  value="Send"
                  class="btn btn-outline-primary d-block d-sm-inline"
                  @click.prevent="submitForm"
                />
              </div>
            </div>
          </form>
        </div>
        <!-- .modal-body -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactFormModal",
  data() {
    return {
      url: "/wp-json/mrh/submit-contact-form",
      form: {
        first_name: "",
        last_name: "",
        contact_email: "",
        contact_phone: "",
        state_of_residence: "",
        contact_method: "",
        age: "",
        horse_owner: "",
        adoption_time_frame: "",
        horse_type: "",
        stabling_location: "",
        questions_comments: ""
      },
      errors: []
    };
  },
  props: {
    horse: {
      type: Object
    },
    informationDisplayed: {
      type: Array
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
    }
  },
  methods: {
    submitForm() {
      console.log("submitted");
      axios
        .post(this.url, this.form)
        .then(response => {
          console.log(response);
          this.errors = [];
        })
        .catch(error => {
          this.errors = JSON.parse(error.response.data.message);
        });
    },
    closeModal() {
      this.$emit("closeModal");
    },
    displayProps(animal) {
      let propsToDisplay = [];
      let propsAvailable = ["breed", "gender", "age", "height"];
      let self = this;
      propsAvailable.forEach(function(el) {
        if (
          self.informationDisplayed.includes(el) &&
          animal.hasOwnProperty(el)
        ) {
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
    }
  },
  computed: {
    buttonClass() {
      return "mrh-btn mrh-btn-secondary mrh-btn-" + this.buttonTypes;
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
