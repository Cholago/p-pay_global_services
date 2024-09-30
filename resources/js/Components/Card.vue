<template>
    <div class="card">
      <template v-if="header">
        <div class="card-header px-4 py-3 rounded-t-lg bg-gray-100">
          <slot name="header">{{ header }}</slot>
        </div>
      </template>
      <div class="card-body px-4 py-5">
        <slot />
      </div>
      <template v-if="footer">
        <div class="card-footer px-4 py-3 rounded-b-lg bg-gray-100">
          <slot name="footer">{{ footer }}</slot>
        </div>
      </template>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      header: String,
      footer: String,
    },
  };
  </script>
  
  <style scoped>
  
  </style>
  