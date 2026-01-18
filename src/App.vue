<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header class="mb-2">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">

        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>

    </nav>
  </header >

  <RouterView />
</template>

<style scoped>

</style>
