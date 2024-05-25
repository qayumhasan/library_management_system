<template>
  <div class="content">
    <div class="container-fluid">
      <h4 class="page-title">Borrowd Books</h4>
      <div class="row">
        <div class="col">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <div class="card-title">Borrowd Book List</div>
              <button class="btn btn-primary" @click="showModal = true">
                Create
              </button>
            </div>
            <div class="card-body">
              <table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book</th>
                    <th scope="col">Author</th>
                    <th scope="col">Member</th>
                    <th scope="col">Borrow Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(borrowed, index) in borrowedBooks" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{borrowed?.book?.title}}</td>
                    <td>{{borrowed?.book?.author?.author_name}}</td>
                    <td>{{borrowed?.member?.full_name}}</td>
                    <td>{{borrowed.borrow_date}}</td>
                    <td>{{borrowed.return_date}}</td>
                    <td>{{borrowed.status}}</td>
                    <td>
                      <span
                        type="button"
                        @click="edit(borrowed)"
                        class="cursor-pointer btn-secondary p-1 btn mx-1"
                      >
                        <i class="la la-edit"></i>
                      </span>
                      <span
                        type="button"
                        class="cursor-pointer btn-warning p-1 btn mx-1"
                        @click="removeBorrowedBook(borrowed)"
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
          <h6 class="modal-title">Borrow a Book</h6>
        </template>
        <template v-slot:body>
          <form>
            <div class="form-group">
              <p for="author_name">Member Name</p>
              <el-select
                v-model="formData.member_id"
                filterable
                placeholder="Select"
                style="width: 240px"
                class="w-100"
              >
                <el-option
                  v-for="member in members"
                  :key="member.id"
                  :label="member.full_name"
                  :value="member.id"
                />
              </el-select>
              <small
                id="emailHelp"
                v-if="errors.member_id"
                class="form-text text-muted text-danger"
                >{{ errors.member_id[0] }}</small
              >
            </div>

            <div class="form-group">
              <p for="author_name">Book Name</p>
              <el-select
              v-model="formData.book_id"
                filterable
                placeholder="Select"
                style="width: 240px"
                class="w-100"
              >
                <el-option
                  v-for="book in books"
                  :key="book.id"
                  :label="book.title"
                  :value="book.id"
                />
              </el-select>
              <small
                id="emailHelp"
                v-if="errors.book_id"
                class="form-text text-muted text-danger"
                >{{ errors.book_id[0] }}</small
              >
            </div>

            <div class="form-group">
                <p for="published_date">Borrow Date</p>
                <el-date-picker
                v-model="formData.borrow_date"
                  class="w-100"
                  type="datetime"
                  placeholder="Pick a Date"
                  format="YYYY/MM/DD"
                  value-format="YYYY-MM-DD"
                />
                <small
                id="emailHelp"
                v-if="errors.borrow_date"
                class="form-text text-muted text-danger"
                >{{ errors.borrow_date[0] }}</small
              >
              </div>

              <div class="form-group">
                <p for="published_date">Return Date</p>
                <el-date-picker
                v-model="formData.return_data"
                  class="w-100"
                  type="datetime"
                  placeholder="Pick a Date"
                  format="YYYY/MM/DD"
                  value-format="YYYY-MM-DD"
                />
                <small
                id="emailHelp"
                v-if="errors.return_data"
                class="form-text text-muted text-danger"
                >{{ errors.return_data[0] }}</small
              >
              </div>

              <div class="form-group">
              <p for="author_name">Status</p>
              <el-select
              v-model="formData.status"
                filterable
                placeholder="Select"
                style="width: 240px"
                class="w-100"
              >
                <el-option
                  v-for="(item,index) in options"
                  :key="index"
                  :label="item"
                  :value="item"
                />
              </el-select>
              <small
                id="emailHelp"
                v-if="errors.status"
                class="form-text text-muted text-danger"
                >{{ errors.status[0] }}</small
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
              @click="borrowedBook"
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
  name: "BorrowdBookListComponent",
  data() {
    return {
      showModal: false,
      isUpdate:false,
      errors: {},
      options:{
        'Borrowed':'Borrowed','Returned':'Returned','Overdue':'Overdue'
      },
      formData:{
        id:'',
        member_id:'',
        book_id:'',
        borrow_date:'',
        return_data:'',
        status:''
      }
    };
  },
  mounted(){
    this.getBooks();
    this.getMembers();
    this.getBorrowedBooks();
  },
  methods:{
    ...mapActions("books", ["getBooks"]),
    ...mapActions("members", ["getMembers"]),
    ...mapActions("borrowed", ["submit","getBorrowedBooks","removeBorrowedBook","borrowedBookUpdate"]),

    borrowedBook() {
      this.submit(this.formData)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.formData.member_id = '',
          this.formData.book_id = '',
          this.formData.borrow_date = '',
          this.formData.return_data = '',
          this.formData.status = ''
          this.isUpdate =false
        })
        .catch((error) => {
            this.errors = error.response.data.errors;
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

    update() {
      this.borrowedBookUpdate(this.formData)
        .then((res) => {
          ElNotification({
            title: "Success",
            message: res.message,
            type: "success",
          });
          this.showModal = false;
          this.formData.member_id = '',
          this.formData.book_id = '',
          this.formData.borrow_date = '',
          this.formData.return_data = '',
          this.formData.status = ''
          this.isUpdate =false
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
        this.formData.id = data.id,
        this.formData.member_id = data.member_id,
        this.formData.book_id = data.book_id,
        this.formData.borrow_date = data.borrow_date,
        this.formData.return_data = data.return_date,
        this.formData.status = data.status,
        this.showModal = true;
    },
  },
  computed: {
    ...mapState("books", ["books"]),
    ...mapState("members", ["members"]),
    ...mapState("borrowed", ["borrowedBooks"]),
  },
};
</script>


