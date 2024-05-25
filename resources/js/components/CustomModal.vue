<template>
  <div v-if="isVisible" class="modal-overlay">
    <div class="modal-dialog" :style="{ width: modalWidth }">
      <div class="modal-content">
        <div class="modal-header">
          <slot name="header">
            <h6 class="modal-title"></h6>
          </slot>
          <button type="button" class="close" @click="close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <slot name="body">

          </slot>
        </div>
        <div class="modal-footer">
          <slot name="footer">
            <button type="button" class="btn btn-secondary" @click="close">
              Close
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

  <script>
export default {
  name: "CustomModal",
  props: {
    isVisible: {
      type: Boolean,
      default: false,
    },
    width: {
      type: String,
      default: "35%",
    },
  },

  methods: {
    close() {
      this.$emit("close");
    },
  },
  computed: {
    modalWidth() {
      return this.width;
    }
  },
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: flex-start; /* Align items to the top */
  padding-top: 2rem; /* Add some padding to the top */
  z-index: 1050;
}

.modal-dialog {
  max-width: 100%;
}

.modal-content {
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem;
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #e9ecef;
}

.modal-title {
  margin: 0;
  font-size: 1.25rem;
}

.close {
  padding: 0.75rem 1.25rem;
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

.modal-body {
  position: relative;
  padding: 1rem;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  padding: 0.75rem;
  border-top: 1px solid #e9ecef;
}

.btn {
  display: inline-block;
  font-weight: 400;
  color: #212529;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-secondary {
  color: #fff;
  background-color: #6c757d;
  border-color: #6c757d;
}
</style>
