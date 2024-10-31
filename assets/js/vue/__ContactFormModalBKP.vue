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
          <form id class action accept-charset="UTF-8" method="post">
            <input name="utf8" type="hidden" value="✓" />
            <input
              type="hidden"
              name="authenticity_token"
              value="uhbmmv1/hlQkrwSZs7T96tkLdLCa5VAzmet5vKG9KEGbVXjqVzzxviHr9gE6T4m5HM/tnX2VdUz6iRmsI4rUmw=="
            />
            <div class="form-row">
              <div class="form-group col-sm-6 pr-sm-2 required">
                <label for="listing_inquiry_first_name">First Name</label>
                <input
                  class="form-control"
                  placeholder="John"
                  type="text"
                  name="listing_inquiry[first_name]"
                  id="listing_inquiry_first_name"
                  style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;"
                />
              </div>
              <div class="form-group col-sm-6 pl-sm-2 required">
                <label for="listing_inquiry_last_name">Last Name</label>
                <input
                  class="form-control"
                  placeholder="Smith"
                  type="text"
                  name="listing_inquiry[last_name]"
                  id="listing_inquiry_last_name"
                />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-6 pr-sm-2 required">
                <label for="listing_inquiry_contact_email">Email</label>
                <input
                  class="form-control"
                  placeholder="person@place.com"
                  type="text"
                  name="listing_inquiry[contact_email]"
                  id="listing_inquiry_contact_email"
                />
              </div>
              <div class="form-group col-sm-6 pl-sm-2 required">
                <label for="listing_inquiry_contact_phone">Phone</label>
                <input
                  class="form-control"
                  placeholder="555-555-5555"
                  type="text"
                  name="listing_inquiry[contact_phone]"
                  id="listing_inquiry_contact_phone"
                />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-4 required">
                <label for="listing_inquiry_state_of_residence">Your current state of residence.</label>

                <select
                  class="form-dropdown"
                  name="listing_inquiry[state_of_residence]"
                  id="listing_inquiry_state_of_residence"
                >
                  <option value>Select a state</option>
                  <option value="AL">AL</option>
                  <option value="AK">AK</option>
                  <option value="AZ">AZ</option>
                  <option value="AR">AR</option>
                  <option value="CA">CA</option>
                  <option value="CO">CO</option>
                  <option value="CT">CT</option>
                  <option value="DE">DE</option>
                  <option value="DC">DC</option>
                  <option value="FL">FL</option>
                  <option value="GA">GA</option>
                  <option value="HI">HI</option>
                  <option value="ID">ID</option>
                  <option value="IL">IL</option>
                  <option value="IN">IN</option>
                  <option value="IA">IA</option>
                  <option value="KS">KS</option>
                  <option value="KY">KY</option>
                  <option value="LA">LA</option>
                  <option value="ME">ME</option>
                  <option value="MD">MD</option>
                  <option value="MA">MA</option>
                  <option value="MI">MI</option>
                  <option value="MN">MN</option>
                  <option value="MS">MS</option>
                  <option value="MO">MO</option>
                  <option value="MT">MT</option>
                  <option value="NE">NE</option>
                  <option value="NV">NV</option>
                  <option value="NH">NH</option>
                  <option value="NJ">NJ</option>
                  <option value="NM">NM</option>
                  <option value="NY">NY</option>
                  <option value="NC">NC</option>
                  <option value="ND">ND</option>
                  <option value="OH">OH</option>
                  <option value="OK">OK</option>
                  <option value="OR">OR</option>
                  <option value="PA">PA</option>
                  <option value="PR">PR</option>
                  <option value="RI">RI</option>
                  <option value="SC">SC</option>
                  <option value="SD">SD</option>
                  <option value="TN">TN</option>
                  <option value="TX">TX</option>
                  <option value="UT">UT</option>
                  <option value="VT">VT</option>
                  <option value="VA">VA</option>
                  <option value="WA">WA</option>
                  <option value="WV">WV</option>
                  <option value="WI">WI</option>
                  <option value="WY">WY</option>
                </select>
              </div>
              <div class="form-group col-sm-4">
                <label for="listing_inquiry_contact_method">Preferred contact method?</label>
                <select
                  class="form-dropdown"
                  name="listing_inquiry[contact_method]"
                  id="listing_inquiry_contact_method"
                >
                  <option value>Select a contact method</option>
                  <option value="Phone">Phone</option>
                  <option value="Email">Email</option>
                </select>
              </div>
              <div class="form-group col-sm-4 required">
                <label for="listing_inquiry_age">Are you over 18 years old?</label>
                <select class="form-dropdown" name="listing_inquiry[age]" id="listing_inquiry_age">
                  <option value>Select one</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="mt-3 mb-3">
              <h5>Share your equine experience with us.</h5>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-6 required">
                <label for="listing_inquiry_horse_owner">Are you currently a horse owner?</label>

                <select
                  class="form-dropdown"
                  name="listing_inquiry[horse_owner]"
                  id="listing_inquiry_horse_owner"
                >
                  <option value>Select one</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-sm-6 required">
                <label
                  for="listing_inquiry_adoption_time_frame"
                >What is your time frame for adoption?</label>
                <select
                  class="form-dropdown"
                  name="listing_inquiry[adoption_time_frame]"
                  id="listing_inquiry_adoption_time_frame"
                >
                  <option value>Select a timeframe</option>
                  <option value="As soon as possible">As soon as possible</option>
                  <option value="1 month">1 month</option>
                  <option value="3 months">3 months</option>
                  <option value="6 months">6 months</option>
                  <option value="Within a year">Within a year</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="listing_inquiry_horse_type">What type of horse are you looking for?</label>

                <select
                  class="form-dropdown"
                  name="listing_inquiry[horse_type]"
                  id="listing_inquiry_horse_type"
                >
                  <option value>Select one</option>
                  <option
                    value="Suitable for beginner rider/handler"
                  >Suitable for beginner rider/handler</option>
                  <option
                    value="Suitable for intermediate rider/handler"
                  >Suitable for intermediate rider/handler</option>
                  <option
                    value="Suitable for advanced rider/handler"
                  >Suitable for advanced rider/handler</option>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label
                  for="listing_inquiry_stabling_location"
                >Where do you intend on stabling your adopted horse?</label>

                <input
                  class="form-control"
                  placeholder="Tell us more"
                  type="text"
                  name="listing_inquiry[stabling_location]"
                  id="listing_inquiry_stabling_location"
                />
              </div>
            </div>

            <div class="form-group">
              <label for="listing_inquiry_questions_comments">Questions / Comments</label>

              <textarea
                rows="4"
                class="form-control"
                placeholder="I have a question..."
                name="listing_inquiry[questions_comments]"
                id="listing_inquiry_questions_comments"
              ></textarea>
            </div>

            <div class="row justify-content-center">
              <div class="form-group required">
                <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
                <div data-sitekey="6LfIj2gUAAAAAM8NOm3xaqGAAPG-OvNWFku9D5SC" class="g-recaptcha">
                  <div style="width: 304px; height: 78px;">
                    <div>
                      <iframe
                        src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LfIj2gUAAAAAM8NOm3xaqGAAPG-OvNWFku9D5SC&amp;co=aHR0cHM6Ly93d3cubXlyaWdodGhvcnNlLm9yZzo0NDM.&amp;hl=en&amp;v=v1561357937155&amp;size=normal&amp;cb=jsqhjkqwgp2o"
                        width="304"
                        height="78"
                        role="presentation"
                        name="a-lmwpix48k40n"
                        frameborder="0"
                        scrolling="no"
                        sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"
                      ></iframe>
                    </div>
                    <textarea
                      id="g-recaptcha-response"
                      name="g-recaptcha-response"
                      class="g-recaptcha-response"
                      style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"
                    ></textarea>
                  </div>
                </div>
                <noscript>
                  <div>
                    <div style="width: 302px; height: 422px; position: relative;">
                      <div style="width: 302px; height: 422px; position: absolute;">
                        <iframe
                          src="https://www.google.com/recaptcha/api/fallback?k=6LfIj2gUAAAAAM8NOm3xaqGAAPG-OvNWFku9D5SC"
                          name="ReCAPTCHA"
                          style="width: 302px; height: 422px; border-style: none; border: 0; overflow: hidden;"
                        ></iframe>
                      </div>
                    </div>
                    <div
                      style="width: 300px; height: 60px; border-style: none;
                    bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
                    background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;"
                    >
                      <textarea
                        id="g-recaptcha-response"
                        name="g-recaptcha-response"
                        class="g-recaptcha-response"
                        style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
                      margin: 10px 25px; padding: 0px; resize: none;"
                      ></textarea>
                    </div>
                  </div>
                </noscript>
              </div>
            </div>

            <div class="username_1562600393">
              <label for="listing_inquiry_username">If you are a human, ignore this field</label>
              <input
                type="text"
                name="listing_inquiry[username]"
                id="listing_inquiry_username"
                autocomplete="off"
                tabindex="-1"
              />
            </div>

            <input
              type="hidden"
              value="690"
              name="listing_inquiry[listing_id]"
              id="listing_inquiry_listing_id"
            />
            <div class="row">
              <div class="col-12 d-flex justify-content-center">
                <input
                  type="submit"
                  name="commit"
                  value="Send"
                  class="btn btn-outline-primary d-block d-sm-inline"
                  data-disable-with="Send"
                />
              </div>
            </div>
          </form>
        </div>
        <!-- .modal-body -->

        <div class="mrh-modal-footer">
          <a href="#" :class="buttonClass" :style="buttonStyle" @click="closeModal">Close</a>
          <a :href="contactEmail" :class="buttonClass" :style="buttonStyle">Contact Us</a>
        </div>
        <!-- .modal-footer -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactFormModal",
  props: {
    horse: {
      type: Object
    }
    // buttonColor: {
    //   type: String,
    //   default: "rgba(231, 126, 59, 1)"
    // },
    // buttonTypes: {
    //   type: String,
    //   default: "solid-semi-circular"
    // },
    // contactButtonLabel: {
    //   type: String,
    //   default: "Contact Us"
    // },
    // contactEmailAddress: {
    //   type: String
    // }
  },
  methods: {
    closeModal() {
      this.$emit("closeModal");
    }
  },
  computed: {
    // buttonClass() {
    //   return "mrh-btn mrh-btn-secondary mrh-btn-" + this.buttonTypes;
    // },
    // buttonStyle() {
    //   if (this.buttonTypes.includes("solid")) {
    //     return "background-color: " + this.buttonColor;
    //   } else {
    //     return "border-color: " + this.buttonColor;
    //   }
    // },
    // contactEmail() {
    //   return "mailto:" + this.contactEmailAddress;
    // },
    // disciplines() {
    //   if (this.horse.disciplines) {
    //     return this.horse.disciplines.join(", ");
    //   }
    //   return false;
    // }
  }
}; // export
</script>
