<template>
    <div class="not-found">
      <h1>404 Not Found</h1>
      <p>Oops! The page you're looking for doesn't exist.</p>
      <router-link to="/">Go to Home</router-link>
    </div>
  </template>

  <script>
  export default {
    name: 'NotFound'
  }
  </script>

  <style scoped>
  .not-found {
    text-align: center;
    margin-top: 100px;
  }
  </style>
