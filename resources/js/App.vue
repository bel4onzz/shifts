<template>
  <!-- This example requires Tailwind CSS v3.0+ -->
  <div class="isolate mx-2 shadow-lg">
    <nav
      class="
        relative
        w-full
        flex flex-wrap
        items-center
        justify-between
        py-3
        bg-gray-100
        text-gray-500
        hover:text-gray-700
        focus:text-gray-700
        shadow-lg
      "
    >
      <div
        class="
          container-fluid
          w-full
          flex flex-wrap
          items-center
          justify-between
          px-6
        "
      >
        <div class="container-fluid">
          <a class="text-xl text-black" href="/">HOME</a>
        </div>
      </div>
    </nav>
    <main class="mt-4 shadow-lg shadow-indigo-500/50">
      <router-view></router-view>
    </main>
  </div>
</template>

  <script>
export default {};
</script>
