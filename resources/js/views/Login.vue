<template>
  <div class="login">
    <h1 class="title">Login in the page</h1>
    <form class="form">
      <label class="form-label" for="#email">Email:</label>
      <input class="form-input" type="email" id="email" v-model="email" required placeholder="Email">
      <label class="form-label" for="#password">Password:</label>
      <input class="form-input" type="password" id="password" v-model="password" placeholder="Password">
      <button @click="save" type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      users: [],
      email: "",
      password: ""
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    async save(e){
      e.preventDefault();
      await this.axios
        .post("http://grupokonecta.test/api/auth/login", {
          params: {
            'email': this.email,
            'password': this.password
          }
        })
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.log(error);
          this.users = [];
        });
    },
    async getUsers() {
      await this.axios
        .get("/api/v1/users")
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.log(error);
          this.users = [];
        });
    },
    deleteUser(id) {
      if (confirm("Are you sure to delete this user?")) {
        this.axios
          .delete(`/api/v1/users/${id}`)
          .then(response => {
            this.getUsers();
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.login {
  padding: 2rem;
}
.title {
  text-align: center;
}
.form {
  margin: 3rem auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 20%;
  min-width: 350px;
  max-width: 100%;
  background: rgba(19, 35, 47, 0.9);
  border-radius: 5px;
  padding: 40px;
  box-shadow: 0 4px 10px 4px rgba(0, 0, 0, 0.3);
}
.form-label {
  margin-top: 2rem;
  color: white;
  margin-bottom: 0.5rem;
  &:first-of-type {
    margin-top: 0rem;
  }
}
.form-input {
  padding: 10px 15px;
  background: none;
  background-image: none;
  border: 1px solid white;
  color: white;
  &:focus {
    outline: 0;
    border-color: #1ab188;
  }
}
.form-submit {
  background: #1ab188;
  border: none;
  color: white;
  margin-top: 3rem;
  padding: 1rem 0;
  cursor: pointer;
  transition: background 0.2s;
  &:hover {
    background: #0b9185;
  }
}
</style>
