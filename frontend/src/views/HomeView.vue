<template>
  <div class="home">
    <div class="page-overlay" :class="{ 'fade-out': contentLoaded }">
      <img src="https://www.hackthefuture.be/assets/images/htf-logo.png" alt="Logo" class="logo">
    </div>
    <div id="panorama"></div>
    <div v-if="showModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showModal = false">&times;</span>
        <h2>{{ selectedCelestial?.name }}</h2>
        <img :src="`/images/planeten/${selectedCelestial?.image}`" :alt="selectedCelestial?.name">
        <p>{{ selectedCelestial?.description }}</p>
        <button 
    @click="toggleFavorite"
    :class="['favorite-btn', { 'is-favorite': isInFavorites }]"
  >
    {{ isInFavorites ? 'Remove from Favorites' : 'Add to Favorites' }}
  </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useCelestialsStore } from '@/stores/celestials';
import { onMounted, ref, computed } from 'vue'
const contentLoaded = ref(false)
const showModal = ref(false)
const selectedCelestial = ref(null)
const celestialsStore = useCelestialsStore()
const hotspots = ref([])
const mounted = ref(true)

const isInFavorites = computed(() => {
  if (!selectedCelestial.value) return false
  return celestialsStore.isInFavorites(selectedCelestial.value.id)
})

function toggleFavorite() {
  if (!selectedCelestial.value) return
  celestialsStore.toggleFavorite(selectedCelestial.value.id)
}

onMounted(async () => {
  const celestialData = await celestialsStore.getCelestials()
  hotspots.value = celestialData.map(celestial => ({  
    pitch: celestial.pitch,
    yaw: celestial.yaw,
    cssClass: "custom-hotspot",
    createTooltipFunc: hotspot,
    createTooltipArgs: celestial
  }))
  console.log(hotspots.value);
  
  window.pannellum.viewer('panorama', {
    type: 'equirectangular',
    panorama: '/images/360.png',
    autoLoad: true,
    showControls: false,
    "hotSpots": hotspots.value
  })
  setTimeout(() => {
    contentLoaded.value = true
    setTimeout(() => {
      mounted.value = false
    }, 1000)
  }, 1000)
})


function hotspot(hotSpotDiv, args) {
    hotSpotDiv.classList.add('custom-tooltip');
    const img = document.createElement('img');
    img.src = `http://localhost:5173/images/planeten/${args.image}`
    img.classList.add('hotspot-image');
    img.style.width = `${args.size * 1.2}px`;
    img.style.height = `${args.size * 1.2}px`;
    hotSpotDiv.appendChild(img);

    hotSpotDiv.addEventListener('click', () => {
        console.log(args.name);
        selectedCelestial.value = args;
        showModal.value = true;
    });
    
    hotSpotDiv.appendChild(img);

  }
</script>

  
<style>

.favorite-btn {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  background: #3498db;
  color: white;
  transition: all 0.3s ease;
}

.favorite-btn.is-favorite {
  background: #e74c3c;
}

.favorite-btn:hover {
  transform: scale(1.05);
}
  #panorama {
    min-width: 100vw;
    min-height: 100vh;
  }

  .custom-hotspot {
    height: 50px;
    width: 50px;
    transition: height 0.3s ease;
  }

  .modal {
    font-family: sans-serif;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    text-align: center;
    backdrop-filter: blur(5px);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background: linear-gradient(145deg, #ffffff, #f0f0f0);
    padding: 2rem;
    border-radius: 20px;
    max-width: 600px;
    width: 90%;
    max-height: 85vh;
    overflow: auto;
    position: relative;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    transform-origin: center;
    animation: scaleIn 0.3s ease;
}

.modal-content img {
    width: 100px;
    border-radius: 12px;
    margin: 1rem 0;

}

.modal-content h2 {
    color: #2c3e50;
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.modal-content p {
    color: #34495e;
    line-height: 1.6;
    margin: 1rem 0;
}

.close {
    position: absolute;
    right: 20px;
    top: 20px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e74c3c;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.3s ease;
}

.close:hover {
    background: #c0392b;
    transform: rotate(90deg);
}

.hotspot-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    animation: rotate 20s linear infinite;
}


@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes scaleIn {
    from { 
        transform: scale(0.8);
        opacity: 0;
    }
    to { 
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        padding: 1.5rem;
    }
}

.page-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
    transition: opacity 1s ease;
    opacity: 1;
}

.page-overlay.fade-out {
    opacity: 0;
    pointer-events: none;
}

.logo {
    width: 200px;
    height: auto;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

  
</style>