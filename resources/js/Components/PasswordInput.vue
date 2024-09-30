<script setup>
import { onMounted, ref, defineProps } from "vue";
import { EyeIcon, EyeSlashIcon } from "@heroicons/vue/20/solid";

const model = defineModel({
  type: String,
  required: true,
});

const props = defineProps({
  // Prop definitions here
  placeholder: String, // Prop named "message" with expected type String
});

const input = ref(null);
const showPassword = ref(false);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <div>
    <div class="relative mt-2 rounded-md shadow-sm">
      <input
        :type="showPassword ? 'text' : 'password'"
        v-model="model"
        ref="input"
        :placeholder="props.placeholder"
        class="block w-full rounded-md border-0  pr-10 ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
      />
      <div
        @click="showPassword = !showPassword"
        class="pointer-events-auto absolute inset-y-0 right-0 flex items-center pr-3 hover:cursor-pointer"
      >
        <EyeIcon
          v-if="showPassword"
          class="h-5 w-5 text-gray-400"
          aria-hidden="true"
        />
        <EyeSlashIcon
          v-else
          class="h-5 w-5 text-gray-400"
          aria-hidden="true"
        />
      </div>
    </div>
  </div>
</template>
