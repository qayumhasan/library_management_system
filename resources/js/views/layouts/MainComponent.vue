<template>
    <!-- header component start from here -->
  <header-component />
  <!-- sidebar component start from here -->
  <sidebar-component />
  <!-- main dynamic component start from here -->
  <div class="main-panel">
    <RouterView />
  </div>
  <!-- footer component start from here -->
  <footer-component />
</template>
<script>
import HeaderComponent from "@/components/inc/HeaderComponent.vue";
import SidebarComponent from "@/components/inc/SidebarComponent.vue";
import FooterComponent from "@/components/inc/FooterComponent.vue";
export default {
  name: "AppComponent",
  components: { HeaderComponent, SidebarComponent, FooterComponent },
};
</script>
