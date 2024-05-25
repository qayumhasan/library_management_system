<template>
  <div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
      <div class="user">
        <div class="photo">
            <i class="la la-bell"></i>
        </div>
        <div class="info">
          <a
            class=""
            data-toggle="collapse"
            href="#collapseExample"
            aria-expanded="true"
          >
            <span>
              {{ getUser?.name }}
              <!-- <span class="user-level">Administrator</span> -->
              <span class="caret"></span>
            </span>
          </a>
          <div class="clearfix"></div>
        </div>
      </div>
      <ul class="nav">
        <li class="nav-item active">
          <router-link :to="{ name: 'home' }">
            <i class="la la-dashboard"></i>
            <p>Dashboard</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>

        <li class="nav-item active">
          <router-link :to="{ name: 'authors' }">
            <i class="la la-dashboard"></i>
            <p>Authors</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>

        <li class="nav-item active">
          <router-link :to="{ name: 'books' }">
            <i class="la la-dashboard"></i>
            <p>Books</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>

        <li class="nav-item active">
          <router-link :to="{ name: 'members' }">
            <i class="la la-dashboard"></i>
            <p>Members</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>

        <li class="nav-item active">
          <router-link :to="{ name: 'borrowd_books' }">
            <i class="la la-dashboard"></i>
            <p>Borrowd Books</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link :to="{ name: 'users' }">
            <i class="la la-dashboard"></i>
            <p>Users</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link :to="{ name: 'roles' }">
            <i class="la la-dashboard"></i>
            <p>Roles</p>
            <span class="badge badge-count"></span>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  name: "SideBarComponent",
  computed: {
    getUser(){
        const user = localStorage.getItem("user_info");
        if(user){
            return JSON.parse(user);
        }
    }

  },
};
</script>
