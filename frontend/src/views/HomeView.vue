<template>
    <div class="home">
      <div id="panorama"></div>
    </div>
    <div class="cursor">Hallo allemaal</div>
</template>
    
<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  window.pannellum.viewer('panorama', {
    type: 'equirectangular',
    panorama: '/images/360.png',
    autoLoad: true
  })
})
</script>

  
<style scoped>
  #panorama {
    width: 100%;
    height: 500px;
  }
  #cursor {
    cursor: url(/cursor.png);
  }
</style>