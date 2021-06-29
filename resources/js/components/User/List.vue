<template>
  <div class="row">
    <div class="col-12 mb-2 text-end">
      <router-link :to="{ name: 'userAdd' }" class="btn btn-primary">
        Create
      </router-link>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Users</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th></th>
                </tr>
              </thead>
              <tbody v-if="users.length > 0">
                <tr v-for="(user, key) in users" :key="key">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'userEdit',
                        params: { id: user.id }
                      }"
                      class="btn btn-success">
                      Edit
                    </router-link>
                    <button
                      type="button"
                      @click="deleteUser(user.id)"
                      class="btn btn-danger">
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="5" align="center">No Users Found.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "users",
  data() {
    return {
      users: []
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
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
