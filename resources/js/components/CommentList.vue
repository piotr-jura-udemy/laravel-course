<template>
  <div>
    <div v-if="commentsWithUrls.length">
      <div v-for="comment in commentsWithUrls" :key="comment.id">
        <div class="card mb-2">
          <div class="card-body">
            <div>{{ comment.content }}</div>
            <div class="text-muted">
              <i class="far fa-clock"></i>
              Added {{ comment.created_at }} by
              <a
                :href="comment.authorUrl"
              >{{ comment.author.name }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div v-if="this.loading && !this.error">
        <i class="fas fa-sync fa-spin fa-3x"></i>
      </div>
      <div v-if="!this.loading && !this.error">No comments yet!</div>
      <div v-if="this.error">Error loading comments!</div>
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
      routes: route().current(),
      loading: false,
      error: false
    };
  },
  methods: {
    load: function() {
      console.log(this.post);
      this.error = false;
      this.loading = true;
      setTimeout(() => {
        axios
          .get(`/api/v1/posts/${this.post}/comments`)
          .then(res => {
            this.loading = false;
            this.error = false;
            return res.data.data;
          })
          .then(comments => (this.comments = comments))
          .catch(err => {
            this.loading = false;
            this.error = true;
          });
      }, 1000);
    },
    addComment: function(comment) {
      console.log(comment);
      this.comments.unshift(comment);
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
    Echo.channel(`post.${this.post}`).listen(".comment.posted", e => {
      this.addComment(e);
    });
    EventBus.$on("comment-posted", this.addComment);
  }
};
</script>