<template>
        <div>
           <h1>Test</h1>
        </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

router.on('start', (event) => {
  console.log(`The route changed to ${event.detail.visit.url}`)
})
</script>
