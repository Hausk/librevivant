<template>
    <nav class="flex items-center justify-between flex-wrap bg-transparent p-10">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <Link href="/" class="font-semibold text-lg tracking-tight mr-5 uppercase backdrop-blur-sm">Home</Link>
        <Link href="/works" class="font-semibold text-lg tracking-tight uppercase backdrop-blur-sm">Works</Link>
    </div>
    <div class="">
        <h1 class="text-white text-4xl font-semibold uppercase">Victoria Dos Santos</h1>
    </div>
    <div class="flex justify-between">
        <a href="https://www.linkedin.com/in/victoria-dos-santos-60bb6b22b" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'linkedin-in']" size="lg" /></a>
        <a href="https://m.facebook.com/profile.php?id=100072519471892" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'facebook']" size="lg" /></a>
        <a href="https://www.instagram.com/libre_vivant_photographie/?igshid=YmMyMTA2M2Y%3D" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'instagram']" size="lg" /></a>
        <a href="https://www.tiktok.com/@libre_vivant" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'tiktok']" size="lg" /></a>
        <a href="mailto:libre.vivant.photographe@gmail.com" target="_blank" class="text-white"><font-awesome-icon :icon="['fas', 'envelope']" size="lg" /></a>
    </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>
