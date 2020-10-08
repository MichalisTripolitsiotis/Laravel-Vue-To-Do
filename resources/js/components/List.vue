<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Task List</div>
        <div class="card-body">
          <table>
            <tr>
              <th width="50%">Completed</th>
              <th width="50%">Task</th>
              <th width="50%">Edit</th>
              <th width="50%">Delete</th>
            </tr>
            <tr v-for="task in list" :key="task.id">
              <td style="color: red" v-if="task.completed == 0">Uncompleted</td>
              <td style="color: green" v-else>Completed</td>
              <td>{{ task.body }}</td>
              <td>
                <button
                  v-if="task.id"
                  class="btn btn-success btn-sm"
                  @click="openModal(task.id)"
                >
                  Edit
                </button>
              </td>
              <td>
                <button
                  v-if="task.id"
                  class="btn btn-danger btn-sm"
                  @click="deleteTask(task)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <!--MODAL-->
      <div v-if="myModal">
        <div
          class="modal fade"
          id="EditModal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div
            class="modal-dialog"
            role="document"
            v-for="task in update_list"
            :key="task.id"
          >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Task: {{ task.id }}
                </h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Task</label>
                  <input
                    id="body"
                    name="body"
                    type="text"
                    class="form-control"
                    :value="task.body"
                  />
                </div>
                <div class="form-group">
                  <label>Completed:</label>
                  <select id="completed">
                    <option
                      name="completed"
                      :value="task.completed"
                      v-if="task.completed == 0"
                    >
                      Uncompleted
                    </option>
                    <option name="completed" value="1">Completed</option>
                    <option
                      name="completed"
                      :value="task.completed"
                      v-if="task.completed == 1"
                    >
                      Completed
                    </option>
                    <option name="completed" value="0">Uncompleted</option>
                  </select>
                </div>
                <br />
                <div align="center">
                  <button
                    type="button"
                    class="btn btn-primary"
                    @click="editTask(task)"
                  >
                    Edit
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "List",
  data() {
    return {
      list: {},
      update_list: {},
      myModal: false,
      body: "",
      completed: "",
    };
  },
  methods: {
    getList() {
      axios.get("/task").then((response) => (this.list = response.data));
    },
    openModal(id) {
      axios
        .get("/" + id)
        .then((response) => (this.update_list = response.data));
      $("#EditModal").modal("show");
      this.myModal = true;
    },

    editTask(task) {
      this.body = document.getElementById("body").value;
      this.completed = document.getElementById("completed").value;
      axios
        .post("/task/" + task.id, {
          body: this.body,
          completed: this.completed,
        })
        .then((response) => {
          $("#success").html(response.data.message);
          window.location.reload(true);
        });
    },

    deleteTask(task) {
      axios.delete("/task/" + task.id).then((response) => {
        window.location.reload(true);
      });
    },
  },
  created() {
    this.getList();
    this.openModal(id);
    this.myModal = false;
    this.list;
    this.update_list;
    this.body;
    this.completed;
  },
};
</script>
