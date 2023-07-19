<template>
	<div as="nav" class="bg-transparent">
		<div class="mx-auto px-2 md:px-6 lg:px-8" :class="{ 'h-screen' : open }">
           		<div class="relative flex h-16 items-center justify-between">
        			<div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
					<!-- Mobile menu button-->
					<div  class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white cursor-pointer">
						<span class="sr-only">Open main menu</span>
						<font-awesome-icon v-on:click="openDrop" v-if="!open" :icon="['fas', 'bars']" />
						<font-awesome-icon v-on:click="openDrop" v-if="open" :icon="['fas', 'xmark']" />
					</div>
		       		</div>
        			<div class="flex flex-2 items-center justify-center md:items-stretch md:justify-start">
				<div class="hidden lg:block">
					<div class="flex items-center flex-shrink-0 text-gray-300 mr-6">
						<Link href="/" class="font-semibold text-md xl:text-lg tracking-tight mr-5 uppercase backdrop-blur-md hover:text-white">Home</Link>
						<Link href="/works" class="font-semibold text-md xl:text-lg tracking-tight uppercase backdrop-blur-md hover:text-white">Works</Link>
					</div>
				</div>
			</div>
			<div class="flex flex-shrink-1 items-center" v-if="!open">
				<h1 class="text-white text-xl xl:text-4xl font-semibold uppercase">Victoria Dos Santos</h1>
			</div>
				<div class="hidden lg:flex justify-between">
					<a href="https://www.linkedin.com/in/victoria-dos-santos-60bb6b22b" target="_blank" class="text-gray-300 hover:text-blue-400 text-md xl:text-lg mr-5"><font-awesome-icon :icon="['fab', 'linkedin-in']" size="xl" /></a>
					<a href="https://m.facebook.com/profile.php?id=100072519471892" target="_blank" class="text-gray-300 hover:text-blue-500 text-md xl:text-lg mr-5"><font-awesome-icon :icon="['fab', 'facebook']" size="xl" /></a>
					<a href="https://www.instagram.com/libre_vivant_photographie/?igshid=YmMyMTA2M2Y%3D" target="_blank" class="text-gray-300 hover:text-white text-md xl:text-lg mr-5"><font-awesome-icon :icon="['fab', 'instagram']" size="xl" /></a>
					<a class="tiktok relative w-9" href="https://www.tiktok.com/@libre_vivant" target="_blank">
						<font-awesome-icon class="text-gray-300 hover:text-white text-md xl:text-lg mr-5 absolute z-10" :icon="['fab', 'tiktok']" size="xl" />
						<font-awesome-icon class="text-red-500 opacity-0 text-md xl:text-lg mr-5 absolute left-0.5 top-0.5 z-0" :icon="['fab', 'tiktok']" size="xl" />
						<font-awesome-icon class="text-blue-500 opacity-0 text-md xl:text-lg mr-5 absolute -left-0.5 -top-0.5" :icon="['fab', 'tiktok']" size="xl" />
					</a>
					<a href="mailto:libre.vivant.photographe@gmail.com" target="_blank" class="text-gray-300 hover:text-white text-md xl:text-lg"><font-awesome-icon :icon="['fas', 'envelope']" size="xl" /></a>
				</div>
			</div>
		<div class="lg:hidden hidden w-screen left-0 top-0 h-0 bg-gradient" :class="{ isOpen : open }">
			<div class="px-2 md:px-6 lg:px-8 relative flex h-16 items-center justify-between">
				<div  class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white cursor-pointer">
					<span class="sr-only">Open main menu</span>
					<font-awesome-icon v-on:click="openDrop" v-if="open" :icon="['fas', 'xmark']" />
				</div>
			</div>
			<div class="flex"  id="mobile-nav-content">
				<div class="px-2 pb-3 pt-2 opacity-0 w-full flex flex-col justify-between h-full">
					<div class="nav-links m-auto">
						<div v-for="item in navigation" :key="item.name" as="a" :href="item.href" class="text-center linkmobile" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white', 'block rounded-md px-3 py-2 text-4xl font-medium mb-12 cursor-pointer']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</div>
					</div>
					<div class="flex justify-between w-1/3 mt-10 mx-auto">
						<a href="https://www.linkedin.com/in/victoria-dos-santos-60bb6b22b" target="_blank" class="text-white mr-5 cursor-pointer"><font-awesome-icon :icon="['fab', 'linkedin-in']" size="xl" /></a>
						<a href="https://m.facebook.com/profile.php?id=100072519471892" target="_blank" class="text-white mr-5 cursor-pointer"><font-awesome-icon :icon="['fab', 'facebook']" size="xl" /></a>
						<a href="https://www.instagram.com/libre_vivant_photographie/?igshid=YmMyMTA2M2Y%3D" target="_blank" class="text-white mr-5 cursor-pointer"><font-awesome-icon :icon="['fab', 'instagram']" size="xl" /></a>
						<a href="https://www.tiktok.com/@libre_vivant" target="_blank" class="text-white mr-5 cursor-pointer"><font-awesome-icon :icon="['fab', 'tiktok']" size="xl" /></a>
						<a href="mailto:libre.vivant.photographe@gmail.com" target="_blank" class="text-white cursor-pointer"><font-awesome-icon :icon="['fas', 'envelope']" size="xl" /></a>
					</div>
				</div>
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
	.tiktok:hover .opacity-0 {
		opacity: 1;
	}
    .bg-gradient {
        background: linear-gradient(125deg, #222, #202020);
        transition: .2s linear;
    }
    .isOpen {
        height: 100vh;
	overflow: hidden;
	display: block;
	position: absolute;
	top: 0;
	right: 0;
	width: 100vw;
    }
    .isOpen div {
	transition-delay: .2s;
	opacity: 1;
    }
    .isOpen #mobile-nav-content {
	display: flex;
	flex-direction: column;
	height: calc(100% - 4rem);
    }
    .isOpen div {
	transition-delay: inherit !important;
	transition: inherit !important;
    }
</style>
