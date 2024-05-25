<template>
  <div class="content">
    <div class="container-fluid">
      <h4 class="page-title">Users</h4>
      <div class="row">
        <div class="col">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <div class="card-title">User List</div>
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
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Permission</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in users" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <ul>
                            <li v-for="(role, index) in user.roles" :key="index">{{ role.name }}</li>
                        </ul>
                    </td>

                    <td>
                        <ul>
                            <li v-for="(permission, index) in user.permissions" :key="index">{{ permission.name }}</li>
                        </ul>
                    </td>
                    <td>
                      <span
                        type="button"
                        @click="edit(user)"
                        class="cursor-pointer btn-secondary p-1 btn mx-1"
                      >
                        <i class="la la-edit"></i>
                      </span>
                      <span
                        type="button"
                        class="cursor-pointer btn-warning p-1 btn mx-1"
                        @click="remove(book)"
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
          <h6 class="modal-title">{{isUpdate?'Update':'Add New'}} User</h6>
        </template>
        <template v-slot:body>
          <form>
            <div class="form-group">
              <label for="book_title">Name</label>
              <input
                type="text"
                class="form-control"
                id="book_title"
                v-model="user.name"
                placeholder="Enter Name"
              />
            </div>

            <div class="form-group">
              <label for="book_title">Email</label>
              <input
                type="text"
                class="form-control"
                id="book_title"
                v-model="user.email"
                placeholder="Enter Email"
              />
            </div>

            <div class="form-group">
              <label for="book_title">Password </label>
              <input
                type="password"
                class="form-control"
                id="book_title"
                v-model="user.password"
                placeholder="Enter password"
              />
            </div>

            <div class="form-group">
              <label for="book_title">Confirm Password </label>
              <input
                type="password"
                class="form-control"
                id="book_title"
                v-model="user.password_confirmation"
                placeholder="Enter Confirm Password"
              />
            </div>

            <div class="form-group">
              <p for="author_name">Add Role</p>
              <el-select
                filterable
                multiple
                placeholder="Select"
                style="width: 240px"
                class="w-100"
                v-model="user.roles"
              >
                <el-option
                  v-for="role in roles"
                  :key="role.id"
                  :label="role.name"
                  :value="role.id"
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
              @click="update"
              class="btn btn-primary"
            >
              Update
            </button>
            <button
              type="button"
              v-else
              @click="submit"
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
      isUpdate:false,
      errors: {},
      user: {
        id: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        roles: "",
      },
    };
  },
  mounted() {
    this.getRoles();
    this.getUser();
  },
  methods: {
    ...mapActions("role", [
      "getRoles",
    ]),
    ...mapActions("user", [
      "register",
      "getUser",
      "userUpdate"
    ]),

    submit() {
      this.register(this.user)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.getUser();
          this.showModal = false;
          this.user.id = "",
          this.user.name = "",
          this.user.email = "",
          this.user.password = "",
          this.user.password_confirmation = "",
          this.user.roles = ""
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
        let super_admin =data.roles.find(item=>item.name == "super-admin")
        if(super_admin){
            ElNotification({
              title: "Errors",
              message: "The super admin role is immutable",
              type: "errors",
            });
            return;
        }
        this.isUpdate = true,
          this.user.id = data.id,
          this.user.name = data.name,
          this.user.email = data.email,
          this.user.password = data.password,
          this.user.confirm_password = data.password_confirmation,
          this.user.roles = data.roles.map(item=>item.id)
          this.showModal = true;
    },

    update() {
      this.userUpdate(this.user)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.getUser();
          this.showModal = false;
          this.user.id = "",
          this.user.name = "",
          this.user.email = "",
          this.user.password = "",
          this.user.password_confirmation = "",
          this.user.roles = ""
          this.isUpdate = false
        })
        .catch((error) => {
            console.log(error);
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
          }
        });

    },

    remove(book) {
      this.removeBook(book)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
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
    ...mapState("user", ["users"]),
    ...mapState("role", ["roles"]),
  },
};
</script>


