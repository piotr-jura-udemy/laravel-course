<template>
  <div>
    <div class="form-group">
      <textarea type="text" name="content" class="form-control" v-model="content" :class="{'is-invalid': errors.content}"></textarea>
      <div class="invalid-feedback" v-if="errors.content">{{ errors.content[0] }}</div>
    </div>

    <button type="submit" class="btn btn-primary btn-block" @click="submit" :disabled="sending">
      <i class="fas fa-sync fa-spin" v-if="sending"></i>
      {{ submitLabel }}
    </button>
  </div>
</template>

<script>
export default {
  props: {
    url: String,
    submitLabel: String
  },
  data: function() {
    return {
      content: "",
      sending: false,
      errors: []
    };
  },
  methods: {
    submit: function() {
      this.sending = true;
      axios
        .post(this.url, { content: this.content })
        .then(res => {
          this.content = "";
          this.sending = false;
          this.errors = [];
          EventBus.$emit("comment-posted", res.data.data);
        })
        .catch(err => {
          this.sending = false;
          this.errors = err.response.data.errors;
        });
    }
  }
};
</script>