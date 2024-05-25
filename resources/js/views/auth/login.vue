<template>
  <div class="content">
    <div class="container">
      <div class="row centered-form">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Login</div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="email">Email Address</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  v-model="data.email"
                  placeholder="Enter Email"
                />
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  v-model="data.password"
                  placeholder="Password"
                />
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <button type="submit" @click="login" class="btn btn-primary">
                  Login
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex";
import { ElNotification } from "element-plus";
export default {
  name: "LoginComponent",
  data() {
    return {
      showModal: false,
      data: {
        email: null,
        password: null,
        remember: null,
      },
    };
  },
  methods: {
    ...mapActions("auth", ["userVarify"]),
    login() {
      this.errors = null;
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("/api/login", this.data)
          .then((response) => {
            this.$router.push({ name: "home" });
            localStorage.setItem("user_info", JSON.stringify(response.data));
          })
          .catch((error) => {
            this.errors = error.response.data;
            localStorage.setItem("user_info", "");
            this.$router.push({ name: "login" });
            console.log(error)
            ElNotification({
              title: "Opps",
              message: error.response.data.errorText,
              type: "errors",
            });
          });
      });
    },
  },
};
</script>
<style scoped>
.centered-form {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
</style>
