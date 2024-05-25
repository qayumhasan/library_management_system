<template>
  <div class="content">
    <div class="container-fluid">
      <h4 class="page-title">Members</h4>
      <div class="row">
        <div class="col">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <div class="card-title">Member List</div>
              <button class="btn btn-primary" @click="showModal = true">
                Create
              </button>
            </div>
            <div class="card-body" v-loading="false">
              <table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(member, index) in members" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ member.full_name }}</td>
                    <td>{{ member.email }}</td>
                    <td>{{ member.phone_number }}</td>
                    <td>
                      <span
                        type="button"
                        @click="edit(member)"
                        class="cursor-pointer btn-secondary p-1 btn mx-1"
                      >
                        <i class="la la-edit"></i>
                      </span>
                      <span
                        type="button"
                        class="cursor-pointer btn-warning p-1 btn mx-1"
                        @click="remove(member)"
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
      <Modal :isVisible="showModal" width="50%" @close="showModal = false">
        <template v-slot:header>
          <h6 class="modal-title">Add New Member</h6>
        </template>
        <template v-slot:body>
          <form>
            <form>
              <div class="row">
                <div class="col">
                  <label for="book_title">First Name</label>
                  <input
                    type="text"
                    v-model="member.first_name"
                    class="form-control"
                    placeholder="First name"
                  />
                  <small
                id="emailHelp"
                v-if="errors.first_name"
                class="form-text text-muted text-danger"
                >{{ errors.first_name[0] }}</small
              >
                </div>
                <div class="col">
                  <label for="book_title">Last Name</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="member.last_name"
                    placeholder="Last name"
                  />
                  <small
                id="emailHelp"
                v-if="errors.last_name"
                class="form-text text-muted text-danger"
                >{{ errors.last_name[0] }}</small
              >
                </div>
              </div>

              <div class="row my-3">
                <div class="col">
                  <label for="book_title">Phone Number</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="member.phone_number"
                    placeholder="Phone Number"
                  />
                  <small
                id="emailHelp"
                v-if="errors.phone_number"
                class="form-text text-muted text-danger"
                >{{ errors.phone_number[0] }}</small
              >
                </div>
                <div class="col">
                  <label for="book_title">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    v-model="member.email"
                    placeholder="Email"
                  />
                  <small
                id="emailHelp"
                v-if="errors.email"
                class="form-text text-muted text-danger"
                >{{ errors.email[0] }}</small
              >
                </div>
              </div>

              <div class="form-group">
                <p for="published_date">Registration Date</p>
                <el-date-picker
                  v-model="member.registration_date"
                  class="w-100"
                  type="datetime"
                  placeholder="Pick a Date"
                  format="YYYY/MM/DD"
                  value-format="YYYY-MM-DD"
                />
                <small
                id="emailHelp"
                v-if="errors.registration_date"
                class="form-text text-muted text-danger"
                >{{ errors.registration_date[0] }}</small
              >
              </div>
            </form>
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
              @click="saveMember"
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
  name: "MemberListComponent",
  data() {
    return {
      showModal: false,
      isUpdate: false,
      errors:{},
      member: {
        id: "",
        first_name: "",
        last_name: "",
        phone_number: "",
        email: "",
        registration_date: "",
      },
    };
  },
  mounted() {
    this.getMembers();
  },
  methods: {
    ...mapActions("members", ["submit", "getMembers","memberUpdate","removeMember"]),
    saveMember() {
      this.submit(this.member)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.member.first_name = "";
          this.member.last_name = "";
          this.member.phone_number = "";
          this.member.email = "";
          this.member.registration_date = "";
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
       this.isUpdate = true
       this.member.id = data.id
      this.member.first_name = data.first_name
      this.member.last_name = data.last_name;
      this.member.phone_number = data.phone_number;
      this.member.email = data.email;
      this.member.registration_date = data.registration_date;
      this.showModal = true;
    },

    update() {
      this.memberUpdate(this.member)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.member.id = "";
          this.member.first_name = "";
          this.member.last_name = "";
          this.member.phone_number = "";
          this.member.email = "";
          this.member.registration_date = "";
          this.isUpdate = false
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
          }
        });
    },

    remove(member) {
      this.removeMember(member)
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
    ...mapState("members", ["members"]),
  },
};
</script>


