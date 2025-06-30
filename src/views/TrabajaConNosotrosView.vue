<template>
  <div class="trabaja-view">
    <TrabajaConNosotrosContent />
  </div>
</template>

<script>
import TrabajaConNosotrosContent from '@/components/TrabajaConNosotrosContent.vue'

export default {
  name: 'TrabajaConNosotrosView',
  components: {
    TrabajaConNosotrosContent
  }
}
</script>

<style scoped>
.trabaja-view {
  padding-top: var(--nav-height, 110px);
  min-height: 100vh;
}

@media (max-width: 991.98px) {
  .trabaja-view {
    padding-top: var(--nav-height, 80px);
  }
}
</style>