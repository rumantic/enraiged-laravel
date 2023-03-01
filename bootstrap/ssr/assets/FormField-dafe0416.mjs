import { useSSRContext } from "vue";
const _sfc_main = {
  inject: ["i18n"],
  props: {
    field: {
      type: Object,
      required: true
    },
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    }
  },
  computed: {
    dirty() {
      return this.form[this.id] !== this.field.value;
    },
    disabled() {
      return this.field.disabled || false;
    },
    error() {
      return this.form ? this.form.errors[this.id] : null;
    },
    label() {
      return this.field.label;
    },
    placeholder() {
      return this.field.placeholder;
    }
  },
  methods: {
    update() {
      if (this.form[this.id] === "" && this.field.value === null) {
        this.form[this.id] = null;
      }
      if (this.form.errors[this.id]) {
        delete this.form.errors[this.id];
      }
      if (!Object.keys(this.form.errors).length) {
        this.form.hasErrors = false;
      }
    }
  },
  render() {
    return this.$slots.default({
      dirty: this.dirty,
      disabled: this.disabled,
      error: this.error,
      form: this.form,
      label: this.label ? this.i18n(this.label) : null,
      placeholder: this.placeholder ? this.i18n(this.placeholder) : null,
      update: this.update
    });
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/headless/FormField.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as _
};
