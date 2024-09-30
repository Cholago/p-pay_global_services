<template>
  <div class="flex items-center">
    <div class="flex relative mt-2 rounded-md shadow-sm">
      <input class="block w-full rounded-md border-0  pr-10 ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-primary-500 sm:text-sm sm:leading-6" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
      <div
        @click="$emit('reset')"
        class="pointer-events-auto absolute inset-y-0 right-0 flex items-center pr-3 hover:cursor-pointer"
      >
        <XMarkIcon
          class="h-5 w-5 text-gray-400"
          aria-hidden="true"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue'
import { XMarkIcon } from "@heroicons/vue/20/solid";


export default {
  components: {
    Dropdown,
    XMarkIcon, 
  },
  props: {
    modelValue: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
  emits: ['update:modelValue', 'reset'],
}
</script>
