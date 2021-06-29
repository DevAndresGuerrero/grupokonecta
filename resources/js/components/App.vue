<template>
  <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand" href="#"
          >Prueba Laravel + Vue.js</router-link
        >
        <div class="collapse navbar-collapse">
          <div class="navbar-nav">
            <router-link
              exact-active-class="active"
              to="/"
              class="nav-item nav-link">
              Home
            </router-link>
            <router-link
              exact-active-class="active"
              to="/user"
              class="nav-item nav-link">
              User
            </router-link>
            <router-link
              exact-active-class="active"
              to="/customer"
              class="nav-item nav-link">
              Customer
            </router-link>
            <router-link
              exact-active-class="active"
              to="/login"
              class="nav-item nav-link">
              Login
            </router-link>
          </div>
        </div>
      </div>
    </nav>
    <div class="container mt-5">
      <router-view></router-view>
    </div>
  </main>
</template>

<script>
export default {};
</script>
