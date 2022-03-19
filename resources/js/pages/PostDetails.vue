<template>
  <section>
    <div class="container">
      <h1>{{ post.title }}</h1>
      <div
        v-if="post.cover"
        class="w-50"
      >
        <img
          :src="post.cover"
          :alt="post.title"
        >
      </div>
      <div v-if="post.category">Category: {{ post.category.name }}</div>
      <div v-if="post.tags && post.tags.length > 0">
        <router-link
          :to="{name: 'tag-details', params: {slug: tag.slug}}"
          v-for="tag in post.tags"
          :key="tag.id"
          class="badge rounded-pill bg-warning text-dark mr-1"
        >{{ tag.name }}</router-link>
      </div>

      <p>{{ post.content }}</p>
      <div>
        <router-link :to="{ name: 'blog' }">Torna al blog</router-link>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "PostDetails",
  data() {
    return {
      post: [],
    };
  },
  methods: {
    getPost() {
      axios.get("/api/posts/" + this.$route.params.slug).then((response) => {
        if (response.data.success) {
          this.post = response.data.results;
        } else {
          this.$router.push({ name: "not-found" });
        }
      });
    },
  },
  created() {
    this.getPost();
  },
};
</script>