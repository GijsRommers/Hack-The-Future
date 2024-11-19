<template>
    <div class="home">
      <div id="panorama"></div>
    </div>
</template>
    
<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  window.pannellum.viewer('panorama', {
    type: 'equirectangular',
    panorama: '/images/360.png',
    autoLoad: true,
    showControls: false,
    "hotSpots": [
        {
            "pitch": 14.1, //naar boven of onder
            "yaw": 23,  //naar links of rechts
            "type": "info",
            "text": "Baltimore Museum of Art",
            "URL": "https://artbma.org/"
        },
        {
            "pitch": 14.1,
            "yaw": 222.6,
            "type": "info",
            "text": "Art Museum Drive"
        },
        {
            "pitch": 14.1,
            "yaw": 144.4,
            "type": "info",
            "text": "North Charles Street"
        }
    ]

  })
})
</script>

  
<style scoped>
  #panorama {
    min-width: 100vw;
    min-height: 100vh;
  }

  
</style>