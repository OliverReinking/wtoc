<template>
  <div class="w-full bg-blue-500">
    <div class="container w-full mx-auto max-w-6xl">
      <nav class="flex flex-col">
        <div class="flex-1 w-full flex flex-col md:flex-row items-center">
          <div id="WTOCLogo" class="hidden md:block py-4 px-4">
            <a href="/about">
              <img src="/images/Logo_WTOC.png" title="WTOC" class="h-8 w-auto">
            </a>
          </div>

          <!-- Links für Screen < md -->
          <div class="md:hidden w-full flex-1 flex flex-col py-4 px-4 items-center text-gray-300">
            <div class="flex flex-col py-4 px-4 text-center">
              <button @click="isMenu = !isMenu" v-show="!isMenu">
                <i class="fa fa-bars text-2xl text-white"></i>
              </button>
              <button @click="isMenu = !isMenu" v-show="isMenu" class="md:hidden">
                <i class="fa fa-times-circle text-2xl text-white"></i>
              </button>
            </div>
            <div v-show="isMenu" class="w-full flex flex-col">
              <div class="w-full flex-1 text-center">
                <a
                  class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white"
                  href="/about"
                >Home</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a
                  class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white"
                  href="/aktion"
                >Aktion</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a
                  class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white"
                  href="/country"
                >Ligen</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white" href="/cup">Cup</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a
                  class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white"
                  href="/worldchampionship"
                >WM</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white" href="/news">News</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a
                  class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white"
                  href="/login"
                >Login</a>
              </div>
              <div class="w-full flex-1 text-center">
                <a
                  class="block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white"
                  href="/signin"
                >Register</a>
              </div>
            </div>
          </div>

          <!-- Links für Screen >= md -->
          <div class="hidden w-full md:flex flex-row py-4 px-4 justify-between items-center text-gray-300">
            <div class="flex flex-row items-center">
              <div class="mr-2 text-center">
                <a
                  class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white"
                  href="/about"
                >Home</a>
              </div>
              <div class="mr-2 text-center">
                <a
                  class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white"
                  href="/aktion"
                >Aktion</a>
              </div>
              <div class="mr-2 text-center">
                <a
                  class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white"
                  href="/country"
                >Ligen</a>
              </div>
              <div class="mr-2 text-center">
                <a class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white" href="/cup">Cup</a>
              </div>
              <div class="mr-2 text-center">
                <a
                  class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white"
                  href="/worldchampionship"
                >WM</a>
              </div>
              <div class="mr-2 text-center">
                <a class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white" href="/news">News</a>
              </div>
            </div>
            <div class="flex flex-row">
              <div class="mr-2 text-center">
                <a
                  class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white"
                  href="/login"
                >Login</a>
              </div>
              <div class="mr-2 text-center">
                <a
                  class="block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white"
                  href="/signin"
                >Register</a>
              </div>
            </div>
          </div>

        </div>
      </nav>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isMenu: false
    };
  }
};
</script>

