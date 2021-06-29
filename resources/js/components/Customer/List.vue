<template>
  <div class="row">
    <div class="col-12 mb-2 text-end">
      <router-link :to="{ name: 'customerAdd' }" class="btn btn-primary">
        Create
      </router-link>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Customers</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Document</th>
                  <th></th>
                </tr>
              </thead>
              <tbody v-if="customers.length > 0">
                <tr v-for="(customer, key) in customers" :key="key">
                  <td>{{ category.id }}</td>
                  <td>{{ category.name }}</td>
                  <td>{{ category.email }}</td>
                  <td>{{ category.address }}</td>
                  <td>{{ category.document }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'customerEdit',
                        params: { id: customer.id }
                      }"
                      class="btn btn-success"
                      >Edit</router-link
                    >
                    <button
                      type="button"
                      @click="deleteCustomer(customer.id)"
                      class="btn btn-danger"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="6" align="center">No Customers Found.</td>
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
  name: "customers",
  data() {
    return {
      customers: []
    };
  },
  mounted() {
    this.getCustomers();
  },
  methods: {
    async getCustomers() {
      await this.axios
        .get("/api/customers")
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          console.log(error);
          this.customers = [];
        });
    },
    deleteCustomer(id) {
      if (confirm("Are you sure to delete this customer?")) {
        this.axios
          .delete(`/api/customers/${id}`)
          .then(response => {
            this.getCustomers();
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  }
};
</script>
