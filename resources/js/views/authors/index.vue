<template>
  <div class="content">
    <div class="container-fluid">
      <h4 class="page-title">Authors</h4>
      <div class="row">
        <div class="col">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <div class="card-title">Author List</div>
              <button class="btn btn-primary" @click="showModal = true">
                Create {{ user }}
              </button>
            </div>
            <div class="card-body">
              <table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Author Name</th>
                    <th scope="col">Author Bio</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(author, index) in authors" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ author.author_name }}</td>
                    <td>{{ author.author_bio }}</td>
                    <td>
                      <span
                        type="button"
                        @click="edit(author)"
                        class="cursor-pointer btn-secondary p-1 btn mx-1"
                      >
                        <i class="la la-edit"></i>
                      </span>
                      <span
                        type="button"
                        class="cursor-pointer btn-warning p-1 btn mx-1"
                        @click="remove(author)"
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
      <Modal :isVisible="showModal" width="25%" @close="showModal = false">
        <template v-slot:header>
          <h6 class="modal-title">
            {{ isUpdate ? "Update" : "Create" }} Author
          </h6>
        </template>
        <template v-slot:body>
          <form>
            <div class="form-group">
              <label for="author_name">Author Name</label>
              <input
                type="text"
                class="form-control"
                id="author_name"
                v-model="author.author_name"
                placeholder="Enter Author Name"
              />
              <small
                id="emailHelp"
                v-if="errors.author_name"
                class="form-text text-muted text-danger"
                >{{ errors.author_name[0] }}</small
              >
            </div>

            <div class="form-group">
              <label for="author_bio">Author Bio</label>
              <textarea
                class="form-control"
                id="author_bio"
                rows="3"
                v-model="author.author_bio"
                placeholder="Enter Author Bio"
              ></textarea>
              <small
                id="emailHelp"
                v-if="errors.author_bio"
                class="form-text text-muted text-danger"
                >{{ errors.author_bio[0] }}</small
              >
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
              @click="submitAuthor"
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
  name: "AuthorListComponent",
  data() {
    return {
      showModal: false,
      isUpdate: false,
      errors: {},
      author: {
        author_id: "",
        author_name: "",
        author_bio: "",
      },
    };
  },
  mounted() {
    this.getAuthors();
  },
  methods: {
    ...mapActions("author", [
      "submit",
      "getAuthors",
      "authorUpdate",
      "removeAuthor",
    ]),
    submitAuthor() {
      this.submit(this.author)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.author.author_name = "";
          this.author.author_bio = "";
          this.errors = {}
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
          }
        });
    },
    edit(data) {
      this.isUpdate = true;
      this.showModal = true;
      this.author.author_id = data.id;
      this.author.author_name = data.author_name;
      this.author.author_bio = data.author_bio;
      this.errors = {}
    },
    update() {
      this.authorUpdate(this.author)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.author.id = "";
          this.author.author_name = "";
          this.author.author_bio = "";
          this.author.author_id = "";
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
          }
        });
        this.isUpdate = false;
    },
    remove(author) {
      this.removeAuthor(author)
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
    ...mapState("author", ["authors"]),
    ...mapState("auth", ["user"]),
  },
};
</script>


