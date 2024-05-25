<template>
  <div class="content">
    <div class="container-fluid">
      <h4 class="page-title">Books</h4>
      <div class="row">
        <div class="col">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <div class="card-title">Book List</div>
              <button class="btn btn-primary" @click="showModal = true">
                Create
              </button>
            </div>
            <div class="card-body">
              <table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Published Date</th>
                    <th scope="col">ISBN Number</th>
                    <th scope="col">Available Copies</th>
                    <th scope="col">Total Copies</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(book, index) in books" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ book.title }}</td>
                    <td>{{ book.author?.author_name }}</td>
                    <td>{{ book.published_date}}</td>
                    <td>{{ book.isbn_number}}</td>
                    <td>{{ book.available_copies}}</td>
                    <td>{{ book.total_copies}}</td>
                    <td>
                      <span
                        type="button"
                        @click="edit(book)"
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
          <h6 class="modal-title">Add Book</h6>
        </template>
        <template v-slot:body>
          <form>
            <div class="form-group">
              <label for="book_title">Book Title</label>
              <input
                type="text"
                class="form-control"
                id="book_title"
                v-model="book.title"
                placeholder="Enter Book Title"
              />
              <small
                id="emailHelp"
                v-if="errors.title"
                class="form-text text-muted text-danger"
                >{{ errors.title[0] }}</small
              >
            </div>

            <div class="form-group">
              <p for="author_name">Author Name</p>
              <el-select
                filterable
                placeholder="Select"
                style="width: 240px"
                class="w-100"
                v-model="book.author_id"
              >
                <el-option
                  v-for="author in authors"
                  :key="author.id"
                  :label="author.author_name"
                  :value="author.id"
                />
              </el-select>
              <small
                id="emailHelp"
                v-if="errors.author_id"
                class="form-text text-muted text-danger"
                >{{ errors.author_id[0] }}</small
              >
            </div>

            <div class="form-group">
              <p for="published_date">Published Date</p>
              <el-date-picker
                v-model="book.published_date"
                class="w-100"
                type="datetime"
                placeholder="Pick a Date"
                format="YYYY/MM/DD"
                value-format="YYYY-MM-DD"
              />
              <small
                id="emailHelp"
                v-if="errors.published_date"
                class="form-text text-muted text-danger"
                >{{ errors.published_date[0] }}</small
              >
            </div>

            <div class="form-group">
              <label for="isbn">ISBN Number</label>
              <input
                type="text"
                v-model="book.isbn_number"
                class="form-control"
                id="isbn"
                placeholder="Enter Book ISBN Number"
              />
              <small
                id="emailHelp"
                v-if="errors.isbn_number"
                class="form-text text-muted text-danger"
                >{{ errors.isbn_number[0] }}</small
              >
            </div>

            <div class="form-group">
              <label for="total_copies">Total Copies</label>
              <input
                type="number"
                class="form-control"
                v-model="book.total_copies"
                id="total_copies"
                placeholder="Enter Total Copies of Books"
              />
              <small
                id="emailHelp"
                v-if="errors.total_copies"
                class="form-text text-muted text-danger"
                >{{ errors.total_copies[0] }}</small
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
              @click="storeBook"
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
      book: {
        id: "",
        title: "",
        author_id: "",
        published_date: "",
        isbn_number: "",
        total_copies: "",
      },
    };
  },
  mounted() {
    this.getBooks();
    this.getAuthors();
  },
  methods: {
    ...mapActions("author", ["getAuthors"]),
    ...mapActions("books", ["submit", "getBooks","bookUpdate","removeBook"]),

    storeBook() {
        this.errors = {};
      this.submit(this.book)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.book.title = "";
          this.book.author_id = "";
          this.book.published_date = "";
          this.book.isbn_number = "";
          this.book.total_copies = "";
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
        this.errors = {};
        this.isUpdate = true,
        this.book.id = data.id
      this.book.title = data.title;
      this.book.author_id = data.author_id;
      this.book.published_date = data.published_date;
      this.book.isbn_number = data.isbn_number;
      this.book.total_copies = data.total_copies;
      this.showModal = true;
    },

    update() {
      this.bookUpdate(this.book)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.book.id = "";
          this.book.title = "";
          this.book.author_id = "";
          this.book.published_date = "";
          this.book.isbn_number = "";
          this.book.total_copies = "";
          this.isUpdate = false
        })
        .catch((error) => {
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
    ...mapState("author", ["authors"]),
    ...mapState("books", ["books"]),
  },
};
</script>


