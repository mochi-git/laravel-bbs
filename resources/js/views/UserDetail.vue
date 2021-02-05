<template>
  <div>
    <div>
      <h1>ユーザ詳細</h1>
      <ul>
        <li>User Id: {{ user.id }}</li>
        <li>User Name: {{ user.name }}</li>
        <li>User Email: {{ user.email }}</li>
      </ul>
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
  created() {
    axios
      .get("/user/" + this.id)
      .then((response) => (this.user = response.data.user))
      .catch((erorr) => console.log(error));
  },
};
</script>
