<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
        <Link v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 focus:text-primary-500 text-sm leading-4 hover:bg-primary-600 border focus:border-primary-500 rounded" :class="{ 'bg-primary-600': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
  
</template>

<script>
import { Link } from '@inertiajs/vue3'
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid'


export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
}
</script>
