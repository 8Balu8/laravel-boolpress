<template>
  <section>
    <div class="container">
      <h1>{{tag.name.charAt(0).toUpperCase() + tag.name.slice(1)}}</h1>
      <div class="row row-cols-3">
        <!-- Single post card -->
        <div
          v-for="post in tag.posts"
          :key="post.id"
          class="col"
        >
          <div class="card my-2">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <div class="card-body">
              <h5 class="card-title">{{ post.title }}</h5>
              <p class="card-text">{{ truncateText(post.content, 50) }}</p>
            </div>
            <!-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">An item</li>
                        </ul> -->
            <div class="card-body">
              <router-link
                :to="{ name: 'post-details', params: { slug: post.slug } }"
                class="card-link"
              >Leggi</router-link>
            </div>
          </div>
        </div>
        <!-- End Single post card -->
      </div>

    </div>
  </section>
</template>

<script>
export default {
  name: "TagDetails",
  data() {
    return {
      tag: [],
    };
  },
  methods: {
    getTag() {
      axios.get("/api/tags/" + this.$route.params.slug).then((response) => {
        this.tag = response.data.results;
      });
    },
    truncateText: function (text, maxCharsNumber) {
      // Prende un testo, se il testo è più lungo di x caratteri
      // lo taglia e aggiunge 3 puntini alla fine
      if (text.length > maxCharsNumber) {
        return text.substr(0, maxCharsNumber) + "...";
      }
      return text;
    },
  },
  created() {
    this.getTag();
  },
};
</script>