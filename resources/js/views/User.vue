<template>
  <div>
    <h1>ユーザ一覧</h1>
    <!-- <ul>
      <li v-for="user in users" v-bind:key="user.id">
        {{ user.name }}
        <router-link :to="`/user/${user.id}`">詳細</router-link>
        <router-link :to="`/user/${user.id}/edit`">更新</router-link>
      </li>
    </ul> -->

    <router-link class="btn btn-success" :to="`/create`">作成</router-link>

    <input type="text" v-model="keyword" />
    <table>
      <tr v-for="user in filteredUsers" :key="user.id">
        <td v-text="user.id"></td>
        <td v-text="user.name"></td>
        <td v-text="user.email"></td>
      </tr>
    </table>

    <hr />

    <ul>
      <li v-for="(user, index) in users" v-bind:key="user.id" class="mb-1">
        {{ user.name }}
        <router-link class="btn btn-success" :to="`/user/${user.id}`"
          >詳細</router-link
        >
        <router-link class="btn btn-primary" :to="`/user/${user.id}/edit`"
          >更新</router-link
        >
        <span class="btn btn-danger" @click="userDelete(index, user.id)"
          >削除</span
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    // keyword: '',
    return {
      users: [],
      keyword: '',
    };
  },
  computed: {
    filteredUsers: function () {
      var users = [];

      for (var i in this.users) {
        var user = this.users[i];

        if (user.name.indexOf(this.keyword) !== -1) {
          users.push(user);
        }
      }

      return users;
    },
  },
  methods: {
    userDelete(index, id) {
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
      .get("/user")
      .then((response) => {
        this.users = response.data.users;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>;