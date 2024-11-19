// stores/celestials.js
import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useCelestialsStore = defineStore('Celestials', () => {
    const favorites = ref([]) // Initialize as empty array

    async function getCelestials() {
        try {
            const response = await axios.get(`http://localhost:8000/api/celestials`)
            return response.data
        } catch (error) {
            console.error('Error:', error)
            throw error
        }
    }

    function isInFavorites(id) {
        if (!favorites.value) favorites.value = [] // Ensure favorites is initialized
        return favorites.value.includes(id)
    }

    function toggleFavorite(id) {
        if (!favorites.value) favorites.value = [] // Ensure favorites is initialized
        const index = favorites.value.indexOf(id)
        if (index === -1) {
            favorites.value.push(id)
        } else {
            favorites.value.splice(index, 1)
        }
    }

    return {
        getCelestials,
        favorites,
        isInFavorites,
        toggleFavorite
    }
})