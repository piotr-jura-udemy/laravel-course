<template>
  <div>
    <div v-for="comment in comments" :key="comment.id">
      <p>{{ comment.content }}</p>
      <p class="text-muted">Added x by {{ comment.author.name }}</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["post"],
  data: function() {
    return {
      comments: []
    };
  },
  methods: {
    load: function() {
      axios
        .get(`/api/v1/posts/${this.post}/comments`)
        .then(res => {
          return res.data.data;
        })
        .then(comments => (this.comments = comments))
        .catch(err => console.log("Failed to load comments"));
    }
  },
  mounted: function() {
    console.log("hi");
    this.load();
  }
};
</script>