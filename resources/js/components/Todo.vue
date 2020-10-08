<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Create new task</div>
          <div class="card-body">
            <p id="success"></p>
            <form @submit.prevent="addNewTask">
              <input
                class="form-control"
                type="text"
                name="title"
                v-model="newTask"
              /><br />
              <button class="btn btn-primary" type="submit" value="Submit">
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <List></List>
  </div>
</template>

<script>
import List from "./List";
export default {
  name: "todo",
  components: {
    List,
  },
  data() {
    return {
      newTask: "",
    };
  },
  methods: {
    addNewTask() {
      axios.post("/", { body: this.newTask }).then((response) => {
        $("#success").html(response.data.message);
        window.location.reload(true);
      });
      this.newTask = "";
    },
  },
};
</script>
<style>
</style>
