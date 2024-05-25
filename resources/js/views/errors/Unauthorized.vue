<template>
    <div class="unauthorized-container">
      <h1 class="unauthorized-title">Unauthorized</h1>
      <p class="unauthorized-message">You don't have permission to access this page.<br/> <strong>Or</strong><br/> It's possible that another module reliant on this one lacks the necessary permissions to retrieve data.</p>
    </div>
  </template>

  <script>
  export default {
    name: 'Unauthorized'
  }
  </script>

  <style scoped>
  .unauthorized-container {
    text-align: center;
    margin-top: 10%;
  }

  .unauthorized-title {
    font-size: 2rem;
    color: #333;
  }

  .unauthorized-message {
    font-size: 1.2rem;
    color: #666;
    margin-top: 20px;
  }
  </style>
