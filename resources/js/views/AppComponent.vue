<template>
  <RouterView />
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
