<template>
  <div>
    <div v-for="comment in commentsWithUrls" :key="comment.id">
      <p>{{ comment.content }}</p>
      <p class="text-muted">
        Added {{ comment.created_at }} by
        <a :href="comment.authorUrl">{{ comment.author.name }}</a>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: Number
  },
  data: function() {
    return {
      comments: [],
      routes: route().current()
    };
  },
  methods: {
    load: function() {
      console.log(this.post);
      axios
        .get(`/api/v1/posts/${this.post}/comments`)
        .then(res => {
          return res.data.data;
        })
        .then(comments => (this.comments = comments))
        .catch(err => console.log("Failed to load comments"));
    }
  },
  computed: {
    commentsWithUrls: function() {
      return this.comments.map(comment => ({
        ...comment,
        created_at: moment(comment.created_at).fromNow(),
        authorUrl: route("users.show", { id: comment.author.id })
      }));
    }
  },
  mounted: function() {
    this.load();
  }
};
</script>