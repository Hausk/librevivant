<template>
    <div as="nav" class="bg-transparent">
		<div class="mx-auto px-2 md:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
        		<div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
		            <!-- Mobile menu button-->
    		        <div  class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
        		        <span class="sr-only">Open main menu</span>
            		    <font-awesome-icon v-on:click="openDrop" v-if="!open" :icon="['fas', 'bars']" />
						<font-awesome-icon v-on:click="openDrop" v-if="open" :icon="['fas', 'xmark']" />
            		</div>
		        </div>
        		<div class="flex flex-2 items-center justify-center md:items-stretch md:justify-start">
            		<div class="hidden lg:block">
                		<div class="flex items-center flex-shrink-0 text-white mr-6">
							<Link href="/" class="font-semibold text-lg tracking-tight mr-5 uppercase backdrop-blur-md">Home</Link>
							<Link href="/works" class="font-semibold text-lg tracking-tight uppercase backdrop-blur-md">Works</Link>
						</div>
            		</div>
            	</div>
				<div class="flex flex-shrink-1 items-center" v-if="!open">
					<h1 class="text-white text-xl xl:text-4xl font-semibold uppercase">Victoria Dos Santos</h1>
				</div>
					<div class="hidden lg:flex justify-between">
						<a href="https://www.linkedin.com/in/victoria-dos-santos-60bb6b22b" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'linkedin-in']" size="lg" /></a>
						<a href="https://m.facebook.com/profile.php?id=100072519471892" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'facebook']" size="lg" /></a>
						<a href="https://www.instagram.com/libre_vivant_photographie/?igshid=YmMyMTA2M2Y%3D" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'instagram']" size="lg" /></a>
						<a href="https://www.tiktok.com/@libre_vivant" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'tiktok']" size="lg" /></a>
						<a href="mailto:libre.vivant.photographe@gmail.com" target="_blank" class="text-white"><font-awesome-icon :icon="['fas', 'envelope']" size="lg" /></a>
					</div>
			</div>
		</div>

		<div class="lg:hidden h-0 bg-gradient" :class="{ isOpen : open }">
			<div class="space-y-1 px-2 pb-3 pt-2">
				<div v-for="item in navigation" :key="item.name" as="a" :href="item.href" class="m-auto text-center" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</div>
				<div class="flex justify-between w-1/3 m-auto">
					<a href="https://www.linkedin.com/in/victoria-dos-santos-60bb6b22b" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'linkedin-in']" size="lg" /></a>
					<a href="https://m.facebook.com/profile.php?id=100072519471892" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'facebook']" size="lg" /></a>
					<a href="https://www.instagram.com/libre_vivant_photographie/?igshid=YmMyMTA2M2Y%3D" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'instagram']" size="lg" /></a>
					<a href="https://www.tiktok.com/@libre_vivant" target="_blank" class="text-white mr-5"><font-awesome-icon :icon="['fab', 'tiktok']" size="lg" /></a>
					<a href="mailto:libre.vivant.photographe@gmail.com" target="_blank" class="text-white"><font-awesome-icon :icon="['fas', 'envelope']" size="lg" /></a>
				</div>
			</div>
		</div>
	</div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const open = ref(false);
const openDrop = () => {
    open.value = !open.value;
};
const navigation = [
    { name: 'HOME', href: '/' },
    { name: 'WORKS', href: '/works' },
]
</script>
<style>
    .bg-gradient {
        background: linear-gradient(125deg, #222, #202020);
        transition: .2s linear;
    }
    .isOpen {
        height: 100vh;
    }
    .isOpen div {
        opacity: 1;
    }
</style>
