<template>
  <div class="main-header">
    <div class="logo-header">
      <a href="index.html" class="logo">Library Management </a>
      <button
        class="navbar-toggler sidenav-toggler ml-auto"
        type="button"
        data-toggle="collapse"
        data-target="collapse"
        aria-controls="sidebar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <button class="topbar-toggler more">
        <i class="la la-ellipsis-v"></i>
      </button>
    </div>
    <nav class="navbar navbar-header navbar-expand-lg">
      <div class="container-fluid">
        <form class="navbar-left navbar-form nav-search mr-md-3" action="">
          <div class="input-group">
            <input type="text" placeholder="Search ..." class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="la la-search search-icon"></i>
              </span>
            </div>
          </div>
        </form>

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
          <li class="nav-item dropdown">
            <a
              type="button"
              class="btn btn-primary btn-border my-2 text-bg"
              @click="logout()"
              >Logout</a
            >
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
import { ElNotification } from "element-plus";
export default {
  name: "HeaderComponent",
  methods: {
    ...mapActions("auth", ["userLogout"]),
    logout() {
      this.userLogout().then((res) => {
        ElNotification({
          title: "Success",
          message: "Logout Successfull",
          type: "success",
        });
        this.$router.push({ name: "login" });
      });
    },
  },
};
</script>
