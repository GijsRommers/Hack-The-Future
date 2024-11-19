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
            "pitch": 15, 
            "yaw": 223,  
            "cssClass": "custom-hotspot",
            "createTooltipFunc": hotspot,
            "createTooltipArgs": "North Charles Street",
            "URL": "https://artbma.org/"
        },
        {
            "pitch": 10,
            "yaw": 144.4,
            "cssClass": "custom-hotspot",
            "createTooltipFunc": hotspot,
            "createTooltipArgs": "North Charles Street"
        }
    ]

  })
})


function hotspot(hotSpotDiv, args) {
    console.log("hello");
    hotSpotDiv.classList.add('custom-tooltip');
    var span = document.createElement('span');
    span.innerHTML = args;
    hotSpotDiv.appendChild(span);
    span.style.width = span.scrollWidth - 20 + 'px';
    span.style.marginLeft = -(span.scrollWidth - hotSpotDiv.offsetWidth) / 2 + 'px';
    span.style.marginTop = -span.scrollHeight - 12 + 'px';
}
</script>

  
<style>
  #panorama {
    min-width: 100vw;
    min-height: 100vh;
  }

  .custom-hotspot {
    height: 50px;
    width: 50px;
    background-image: url('/images/planeten/planeet1.png'); /* Fix path */
    background-size: contain; /* Add sizing */
    background-repeat: no-repeat;
    background-position: center;
  }

    .custom-tooltip:hover span:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-width: 10px;
        border-style: solid;
        border-color: #fff transparent transparent transparent;
        bottom: -20px;
        left: -10px;
        margin: 0 50%;
    }

  
</style>