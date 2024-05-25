<template>
    <div>
        <slot></slot>
    </div>
</template>
<script>
export default {
  name: "PermissionComponent",
  methods: {
    hasPermission(permission) {
      alert('ok');
    }
  }
};
</script>

