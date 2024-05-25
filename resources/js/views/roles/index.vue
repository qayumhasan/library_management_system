<template>
  <div class="content">
    <div class="container-fluid">
      <h4 class="page-title">Roles</h4>
      <div class="row">
        <div class="col">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <div class="card-title">Roles</div>
              <button class="btn btn-primary" @click="showModal = true">
                Create
              </button>
            </div>
            <div class="card-body">
              <table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Permission</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(role, index) in roles" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ role.name }}</td>
                    <td>
                      <ul>
                        <li
                          v-for="permission in role.permissions"
                          :key="permission.id"
                        >
                          {{ permission.name }}
                        </li>
                      </ul>
                    </td>
                    <td>
                      <span
                        type="button"
                        @click="edit(role)"
                        class="cursor-pointer btn-secondary p-1 btn mx-1"
                      >
                        <i class="la la-edit"></i>
                      </span>
                      <span
                        type="button"
                        class="cursor-pointer btn-warning p-1 btn mx-1"
                        @click="remove(role)"
                      >
                        <i class="la la-trash"></i>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div>
      <Modal :isVisible="showModal" width="35%" @close="showModal = false">
        <template v-slot:header>
          <h6 class="modal-title">Add Role</h6>
        </template>
        <template v-slot:body>
          <form>
            <div class="form-group">
              <label for="book_title">Name</label>
              <input
                type="text"
                class="form-control"
                id="book_title"
                v-model="role.name"
                placeholder="Enter Role Name"
              />
            </div>

            <div class="form-group">
              <p for="author_name">Add Permission</p>
              <el-select
                filterable
                multiple
                placeholder="Select"
                style="width: 240px"
                class="w-100"
                v-model="role.permissions"
              >
                <el-option
                  v-for="permission in permissions"
                  :key="permission.id"
                  :label="permission.name"
                  :value="permission.id"
                />
              </el-select>
            </div>
          </form>
        </template>
        <template v-slot:footer>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="showModal = false"
            >
              Close
            </button>
            <button
              type="button"
              v-if="isUpdate"
              @click="updateRole"
              class="btn btn-primary"
            >
              Update
            </button>
            <button
              type="button"
              v-else
              @click="storeRole"
              class="btn btn-primary"
            >
              Save
            </button>
          </div>
        </template>
      </Modal>
    </div>
  </div>
</template>

  <script>
import { mapState, mapActions } from "vuex";
import { ElNotification } from "element-plus";
export default {
  name: "BookListComponent",
  data() {
    return {
      showModal: false,
      isUpdate: false,
      errors: {},
      role: {
        id: "",
        name: "",
        permissions: [],
      },
    };
  },
  mounted() {
    this.getPermission();
    this.getRoles();
  },
  methods: {
    ...mapActions("role", [
      "getPermission",
      "submit",
      "getRoles",
      "removeRole",
      "update"
    ]),

    storeRole() {
      this.submit(this.role)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.role.id = "";
          this.role.name = "";
          this.role.permissions = [];
          this.getRoles();
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            ElNotification({
              title: "Errors",
              message: error.response,
              type: "errors",
            });
          }
        });
    },
    edit(data) {
        if(data.name =='super-admin'){
            ElNotification({
              title: "Errors",
              message: "The super admin role is immutable",
              type: "errors",
            });
            return;
        }
      this.isUpdate = true,
      this.role.id = data.id;
      this.role.name = data.name;
      const permissionIds = data.permissions.map((permission) => permission.id);
      this.role.permissions = permissionIds;
      this.showModal = true;
    },

    updateRole() {
        this.update(this.role)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.role.id = "";
          this.role.name = "";
          this.role.permissions = [];
          this.getRoles();
          this.isUpdate = false
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            ElNotification({
              title: "Errors",
              message: error.response,
              type: "errors",
            });
          }
        });
    },

    remove(data) {
        if(data.name =='super-admin'){
            ElNotification({
              title: "Errors",
              message: "The super admin role is immutable",
              type: "errors",
            });
            return;
        }
      this.removeRole(data)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.getRoles();
        })
        .catch((error) => {
          ElNotification({
            title: "Error",
            message: error.response.data.errors,
            type: "error",
          });
        });
    },
  },
  computed: {
    ...mapState("role", ["permissions", "roles"]),
  },
};
</script>


