<script>
import VueCookies from 'vue-cookies';

export default {
  data() {
    return {
      token: VueCookies.get('token')
    }
  },
  methods: {
  }
}
</script>

<template>
    <div v-if="!!token" class="text-orange-50 bg-orange-500 flex px-16">
      <div class="p-2">
        <router-link to="/">Dashboard</router-link>
      </div>
      <div class="p-2">
        <router-link to="/add-poll">Add poll</router-link>
      </div>
    </div>
    <div v-else class="text-orange-50 bg-orange-500 flex px-16">
      <div class="p-2">
        <router-link to="/" >Home</router-link>
      </div>
      <div class="p-2">
        <router-link to="/login">Login</router-link>
      </div>
    </div>
    <div class="px-16 pt-4">
      <router-view></router-view>
    </div>
</template>