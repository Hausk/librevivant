<template>
    <Head title="Works" />
    <NavBar class="absolute w-full z-10"/>
    <div class="carousel overflow-hidden h-screen">
        <div class="carousel-item" v-for="(category, index) in categories" :key="category.id" ref="carouselItems"  @click="handleOnClick(category.slug, $event)" :data-slug="category.slug">
            <div class="carousel-box cursor-pointer">
                <p class="absolute text-white text-xl bottom-4 left-4">{{ category.title }}</p>
                <p class="lg:text-6xl md:text-xl sm:text-lg text-white absolute top-4 left-4">{{ category.year }}</p>
                <img v-if="category.pinned_image" :src="imageUrl(category.pinned_image.filepath)" alt="Pinned Image"/>
                <img v-else :src="getRandomImage()"/>
            </div>
        </div>
    </div>
    <div class="absolute left-3 bottom-2 w-12 text-lg">
        <p id="index" class="text-white relative w-full">
          <span id="test">{{ Math.round(progressRef) + 1 }}</span>
        </p>
        <hr class="text-white m-auto whitespace-nowrap"/>
		<p class="text-white m-auto whitespace-nowrap text-end">{{ categories.length }}</p>
    </div>
</template>
<script setup>
import { ref, onMounted, onUnmounted, reactive, watch } from 'vue';
import { router, Head } from '@inertiajs/vue3';
import gsap from 'gsap'
import NavBar from './../Components/Navbar.vue';

const url = [
        'https://media.istockphoto.com/id/949299844/it/foto/vista-prospettica-dellesterno-delledificio-contemporaneo.jpg?s=612x612&w=0&k=20&c=_DR1aRHuTEV3EYBJo1ZXq1pF4SgwB9EVWQLaBj4sC5g='
    ];
    const getRandomImage = () => {
        return url[0];
    };
    const imageUrl = (url) => {
        return ('/storage/' + url);
    }

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    }
})
let startX = 0;
let active = 0;
let isDown = false;
let progress = 0;
const progressRef = ref(progress);

const speedWheel = 1;
const speedDrag = -0.1;

const disabled = ref(false);

function animateIndex() {
	disabled.value = true
	setTimeout(() => {
		disabled.value = false
	}, 500)
}

const getZindex = (array, index) =>
  array.map((_, i) =>
    index === i ? array.length : array.length - Math.abs(index - i)
  );

const $items = ref([]);
const $cursors = ref([]);

const displayItems = (item, index, active) => {
  const zIndex = getZindex([...$items.value], active)[index];
  item.style.setProperty("--zIndex", zIndex);
  item.style.setProperty(
    "--active",
    (index - active) * 0.12
  );
};

const animate = () => {
	progress = Math.max(0, Math.min(progress, $items.value.length - 1));
	active = Math.floor(progress);
	$items.value.forEach((item, index) =>
		displayItems(item, index, active)
	);
    progressRef.value = progress;
	if (progressRef.value > 0 && progress < $items.value.length + 1) {
		gsap.fromTo('#test', { left: "2rem", opacity: "0", duration: 0.5, ease: "none"} ,{ left: "0", opacity: "1", duration: 0.5, ease: "none" })
	}
};

const handleWheel = (e) => {
    const wheelDelta = e.wheelDelta || 0;
    let wheelProgress = 0;
    // si c'est une souris
	if (wheelDelta == 120 || wheelDelta == 240) {
		if(progress != 0) {
			wheelProgress = -1;
    		progress += wheelProgress;
    		animate();
		}
	} else if (wheelDelta == -120 || wheelDelta == -240) {
		if(progress != $items.value.length - 1) {
			wheelProgress = 1;
    		progress += wheelProgress;
    		animate();
		}
	} else {
		if (wheelDelta > 1) {
			//prev
			if(progress != 0) {
				wheelProgress = - 1 / 10;
    			progress += wheelProgress;
    			animate();
			}
		} else {
			// next
			if(progress != $items.value.length - 1) {
				wheelProgress = 1 / 10;
				progress += wheelProgress;
    			animate();
			}
		}
	}
};

const threshold = 5; // Valeur seuil de déplacement de la souris

const handleMouseMove = (e) => {
  if (e.type === "mousemove") {
    $cursors.value.forEach(($cursor) => {
      $cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
    });
  }
  if (!isDown) return;
  const x = e.clientX || (e.touches && e.touches[0].clientX) || 0;
  const mouseProgress = (x - startX) * speedDrag;

  if (mouseProgress > threshold) {
	if (progress != $items.value.length - 1) {
		progress += 1; // Incrémenter progress de 1 lorsque glisser de gauche à droite
		startX = x; // Mettre à jour la position initiale
  		animate();
	}
  } else if (mouseProgress < -threshold) {
    progress -= 1; // Décrémenter progress de 1 lorsque glisser de droite à gauche
    startX = x; // Mettre à jour la position initiale
  	animate();
  }
};

const handleMouseDown = (e) => {
  isDown = true;
  startX = e.clientX || (e.touches && e.touches[0].clientX) || 0;
};

const handleMouseUp = () => {
  isDown = false;
};

const handleKeyDown = (e) => {
    if (e.key === 'ArrowRight' || e.key == "ArrowDown") {
		if (progress != $items.value.length - 1) {
			progress += 1;
			animate();
		}
    } else if (e.key == 'ArrowLeft' || e.key == 'ArrowUp') {
        if (progress != 0) {
            progress += - 1;
        	animate();
        }
    } else if (e.key == 'Enter') {
        var selectedElement = document.querySelector('.carousel-item[style="--zIndex: 10; --active: 0;"]');
        if (selectedElement) {
            const slug = selectedElement.getAttribute('data-slug');
            router.visit('/work/' + slug, {
                onStart: visit => {
                    console.log('TEST');
                },
                onSuccess: page => {
                    console.log('FINI');
                }
            });
        };
    }
}
const handleOnClick = (slug, event) => {
	var imageElement = '';
	var difference = 0;
	if (event.target.getAttribute('class') == 'carousel-box cursor-pointer') {
  		imageElement = event.target.parentElement;
	} else {
		imageElement = event.target.parentElement.parentElement;
	}
	const zindexValue = imageElement.getAttribute('style').match(/--zIndex:\s*(\d+)/)[1];
	const activeValue = imageElement.getAttribute('style').match(/--active:\s*([-+]?\d+(\.\d+)?)/)[1];
	difference = $items.value.length - zindexValue;
	if (activeValue > 0) {
		progress += difference;
	} else {
		progress += - difference;
	}
	animate();
  setTimeout(() => {
    imageElement.classList.add('zoom-in');
  } , 300);
  setTimeout(() => {
    // Rediriger vers la page souhaitée
    router.visit('/work/' + slug, {
        onStart: visit => {
            console.log('TEST')
        },
        onSuccess: page => {
            console.log('FINI')
        }
    })
  }, 900);
};
const handleOnEnter = (slug) => {
    console.log('TestHandle');
}

onMounted(() => {
    $items.value = Array.from(document.querySelectorAll(".carousel-item"));
    $cursors.value = Array.from(document.querySelectorAll(".cursor"));
    document.addEventListener("mousewheel", handleWheel);
    document.addEventListener("mousedown", handleMouseDown);
    document.addEventListener("mousemove", handleMouseMove);
    document.addEventListener("mouseup", handleMouseUp);
    document.addEventListener("touchstart", handleMouseDown);
    document.addEventListener("touchmove", handleMouseMove);
    document.addEventListener("touchend", handleMouseUp);
    document.addEventListener("keydown", handleKeyDown);
    document.addEventListener("handleOnEnter", handleOnEnter);
    animate()
});

onUnmounted(() => {
    document.removeEventListener("mousewheel", handleWheel);
    document.removeEventListener("mousedown", handleMouseDown);
    document.removeEventListener("mousemove", handleMouseMove);
    document.removeEventListener("mouseup", handleMouseUp);
    document.removeEventListener("touchstart", handleMouseDown);
    document.removeEventListener("touchmove", handleMouseMove);
    document.removeEventListener("touchend", handleMouseUp);
    document.removeEventListener("keydown", handleKeyDown);
    document.removeEventListener("handleOnEnter", handleOnEnter);
});
</script>

<style>

.animatedindex {
  animation: counter-animation .5s ease-in-out;
}

@keyframes counter-animation {
  0% {
    left: 12px;
  }
  100% {
    left: 0;
  }
}
.zoom-in {
  animation: zoomIn 0.5s forwards;
  z-index: 110 !important;
}

@keyframes zoomIn {
  from {
  }
  to {
    width: 100%;
    height: 100%;
    transform: translate(0px, 0px);
    margin: 0;
    top: 0;
    left: 0;
  }
}

.carousel {
  position: relative;
  z-index: 1;
  pointer-events: none;
}

.carousel-item {
  --items: 10;
  --width: clamp(150px, 30vw, 40vh);
  --height: clamp(200px, 40vw, 50vh);
  --x: calc(var(--active) * 900%);
  --y: calc(var(--active) * 400%);
  --rot: calc(var(--active) * 150deg);
  --opacity: calc(var(--zIndex) / var(--items) * 3 - 2);
  overflow: hidden;
  position: absolute;
  z-index: var(--zIndex);
  width: var(--width);
  height: var(--height);
  margin: calc(var(--height) * -0.5) 0 0 calc(var(--width) * -0.5);
  border-radius: 10px;
  top: 50%;
  left: 50%;
  user-select: none;
  transform-origin: 0% 100%;
  box-shadow: 0 1px 20px 1px rgba(255, 0, 0, 0.05);
  background: black;
  pointer-events: all;
  transform: translate(var(--x), var(--y)) rotate(var(--rot));
  transition: transform 0.8s cubic-bezier(0, 0.02, 0, 1);
}
.carousel-item:hover {
  --y: calc(var(--active) * 300% - 20px);
  --x: calc(var(--active) * 925%);
}
.carousel-item .carousel-box {
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: opacity 0.8s cubic-bezier(0, 0.02, 0, 1);
  opacity: var(--opacity);
  font-family: "Roboto", serif;
}
.carousel-item .carousel-box:before {
  content: "";
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 0.5));
}
.carousel-item .title {
  position: absolute;
  z-index: 1;
  color: #fff;
  bottom: 20px;
  left: 20px;
  transition: opacity 0.8s cubic-bezier(0, 0.02, 0, 1);
  font-size: clamp(20px, 3vw, 30px);
  text-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
}
.carousel-item .num {
  position: absolute;
  z-index: 1;
  color: #fff;
  top: 10px;
  left: 20px;
  transition: opacity 0.8s cubic-bezier(0, 0.02, 0, 1);
  font-size: clamp(20px, 10vw, 80px);
}
.carousel-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  pointer-events: none;
}

.layout {
  position: absolute;
  z-index: 0;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}
.layout:before {
  content: "";
  position: absolute;
  z-index: 1;
  top: 0;
  left: 90px;
  width: 10px;
  height: 100%;
  border: 1px solid #fff;
  border-top: none;
  border-bottom: none;
  opacity: 0.15;
}
.layout .box {
  position: absolute;
  bottom: 0;
  left: 30px;
  color: #fff;
  transform-origin: 0% 10%;
  transform: rotate(-90deg);
  font-size: 9px;
  line-height: 1.4;
  text-transform: uppercase;
  opacity: 0.4;
}

.logo {
  position: absolute;
  z-index: 2;
  top: 28px;
  right: 28px;
  width: 30px;
  height: 30px;
  background: #fff;
  border-radius: 50%;
  opacity: 0.5;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: "Roboto", serif;
  pointer-events: all;
  color: black;
  text-decoration: none;
  font-size: 20px;
  overflow: hidden;
  padding-bottom: 0.1em;
}

.social {
  position: absolute;
  z-index: 10;
  bottom: 20px;
  right: 25px;
  color: #fff;
  opacity: 0.4;
}
.social a {
  display: inline-block;
  margin-left: 3px;
}
.social svg {
  --fill: #fff;
  width: 35px;
  height: 35px;
}

.cursor {
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  --size: 40px;
  width: var(--size);
  height: var(--size);
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.2);
  margin: calc(var(--size) * -0.5) 0 0 calc(var(--size) * -0.5);
  transition: transform 0.85s cubic-bezier(0, 0.02, 0, 1);
  display: none;
  pointer-events: none;
}
@media (pointer: fine) {
  .cursor {
    display: block;
  }
}

.cursor2 {
  --size: 2px;
  transition-duration: 0.7s;
}