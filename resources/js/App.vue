<template>
  <div>
    <h2>App</h2>
    <Todo></Todo>
  </div>
</template>

<script>
import Todo from "./components/Todo.vue";
export default {
  name: "App",
  components: {
    Todo,
  },
};
</script>