<template>
  <button
      type="button"
      class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest disabled:opacity-75 enabled:hover:bg-gray-700 transition ease-in-out duration-150"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: 'Button',
}
</script>
