<template>
    <div class="flex items-center">
      <div class="flex w-full bg-white rounded shadow">
        <dropdown :auto-close="false" class="focus:z-10 px-4 hover:bg-gray-100 border-r focus:border-white focus:ring-primary-500 rounded-l focus:ring-2 focus:ring-inset md:px-6" placement="bottom-start">
          <template #default>
            <div class="flex items-baseline">
              <span class="hidden text-gray-700 md:inline">Filter</span>
              <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
              </svg>
            </div>
          </template>
          <template #dropdown>
            <div class="mt-2 px-4 py-6 w-screen bg-white rounded shadow-xl" :style="{ maxWidth: `${maxWidth}px` }">
              <slot />
            </div>
          </template>
        </dropdown>
        <div class="relative rounded-md w-full">
          <input class="block w-full rounded-r-md border-0  pr-10 ring-1 ring-inset ring-white  focus:ring-2 focus:ring-inset focus:ring-primary-500 sm:text-sm sm:leading-6" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
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
    </div>
  </template>
  
  <script>
  import Dropdown from '@/Components/FilterDropdown.vue'
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
  