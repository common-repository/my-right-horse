<template>
  <div :class="elementClass">
    <input type="range" class="multi-range-input multi-range-input-min" v-model="currentMinValue" :min="minValue" :max="maxValue" :step="step">
    <input type="range" class="multi-range-input multi-range-input-max" v-model="currentMaxValue" :min="minValue" :max="maxValue" :step="step" :style="styleAttributeForRange">
  </div>
</template>

<script>
export default {
  props: {
    elementClass: {
      type: String,
      default: "col-4",
    },
    minValue: {
      type: Number,
      required: true,
    },
    maxValue: {
      type: Number,
      required: true,
    },
    selectedMinValue: {
      type: Number,
      required: true,
    },
    selectedMaxValue: {
      type: Number,
      required: true,
    },
    step: {
      type: Number,
      default() {
        return 1;
      },
    },
  },
  data() {
    return {
      currentMinValue: 0,
      currentMaxValue: 100,
    };
  },
  created() {
    this.currentMinValue = this.selectedMinValue;
    this.currentMaxValue = this.selectedMaxValue;
  },
  watch: {
    currentMinValue(newVal) {
      this.$emit("update:selectedMinValue", parseInt(newVal));
    },
    currentMaxValue(newVal) {
      this.$emit("update:selectedMaxValue", parseInt(newVal));
    },
    selectedMinValue(newVal) {
      if (this.currentMinValue !== newVal) {
        this.currentMinValue = newVal
      }
    },
    selectedMaxValue(newVal) {
      if (this.currentMaxValue !== newVal) {
        this.currentMaxValue = newVal
      }
    },
  },
  computed: {
    visualMinValue() {
      const currentMin = parseInt(this.currentMinValue)
      const currentMax = parseInt(this.currentMaxValue)
      return currentMin < currentMax? currentMin: currentMax
    },
    visualMaxValue() {
      const currentMin = parseInt(this.currentMinValue)
      const currentMax = parseInt(this.currentMaxValue)
      return currentMin > currentMax? currentMin: currentMax
    },
    styleAttributeForRange() {
      const min = parseInt(this.minValue)
      const max = parseInt(this.maxValue)
      const visualMin = parseInt(this.visualMinValue)
      const visualMax = parseInt(this.visualMaxValue)
      return `
        --low: ${100 * ((visualMin - min) / (max - min)) + 1 + "%"};
        --high: ${100 * ((visualMax - min) / (max - min)) - 1 + "%"};
      `
    },
  },
};
</script>
