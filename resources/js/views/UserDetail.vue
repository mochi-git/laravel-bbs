<template>
  <div>
    <div>
      <h1>ユーザ詳細</h1>
      <ul>
        <li>User Id: {{ user.id }}</li>
        <li>User Name: {{ user.name }}</li>
        <li>User Email: {{ user.email }}</li>
      </ul>

    <router-link class="btn btn-success" :to="`/user`">戻る</router-link>
      <span class="btn btn-danger" @click="userDelete(user.id)">削除</span>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: this.$route.params.id,
      user: "",
    };
  },
  methods: {
    userDelete(id) {
      axios
        .delete("/user/" + id)
        .then((response) => {
          this.users.slice(id, 1);
        })
        .catch((error) => console.log(error));
    },
  },
  created() {
    axios
      .get("/user/" + this.id)
      .then((response) => (this.user = response.data.user))
      .catch((erorr) => console.log(error));
  },
};
</script>
