<template>
  <div>
    <div v-if="this.typing.length > 0">
      <div class="card mb-2">
        <div class="card-body text-center text-muted">
          {{ this.typingText }} typing
          <i class="far fa-circle fa-pulse fa-sm"></i>
          <i class="far fa-circle fa-pulse fa-sm"></i>
          <i class="far fa-circle fa-pulse fa-sm"></i>
        </div>
      </div>
    </div>

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
      typing: [],
      routes: route().current(),
      loading: false,
      error: false
    };
  },
  methods: {
    load: function() {
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
    },
    typingText: function() {
      if (0 === this.typing.length) {
        return "";
      }

      if ([1, 2].includes(this.typing.length)) {
        return this.typing.join(", ");
      }

      return (
        this.typing.slice(0, 2).join(", ") +
        " and " +
        (this.typing.length - 2) +
        " others "
      );
    }
  },
  mounted: function() {
    this.load();

    Echo.channel(`post.${this.post}`).listen(".comment.posted", e => {
      this.addComment(e);

      if (this.typingTimeouts[e.author.name]) {
        clearTimeout(this.typingTimeouts[e.author.name]);
        this.typing = this.typing.filter(typingPerson => typingPerson != e.author.name);
      }
    });

    Echo.private("comments.typing").listenForWhisper("typing", e => {
      if (e.post == this.post) {
        this.typing = [...new Set(this.typing.concat(e.name))];

        if (this.typingTimeouts[e.name]) {
          clearTimeout(this.typingTimeouts[e.name]);
        }

        const vm = this;

        this.typingTimeouts[e.name] = setTimeout(function() {
          vm.typing = vm.typing.filter(typingPerson => typingPerson != e.name);
        }, 40000);
      }
    });
    EventBus.$on("comment-posted", this.addComment);
  },
  created: function() {
    this.typingTimeouts = {};
  }
};
</script>