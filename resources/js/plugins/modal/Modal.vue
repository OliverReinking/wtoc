<template>
  <div :id="name" class="overlay text-left">
    <a href="#" class="cancel"></a>

    <div class="modal flex flex-col">
      <header class="flex mt-2 text-2xl">
        <slot name="header"></slot>
      </header>

      <slot></slot>

      <footer class="flex mt-2">
        <slot name="footer"></slot>
      </footer>

      <a href="#" class="close text-xl">&times;</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["name"]
};
</script>

<style>
footer:empty {
    display: none;
}
header:empty {
    display: none;
}
.overlay {
  visibility: hidden;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 0, 0, 0.6);
  transition: opacity 1s;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.modal {
  position: relative;
  width: 500px;
  max-width: 80%;
  background: white;
  border-radius: 8px;
  padding: 1.5em;
  box-shadow: 0 5px 11px rgba(36, 37, 38, 0.08);
}
.modal .close {
  position: absolute;
  top: 15px;
  right: 15px;
  color: grey;
  text-decoration: none;
}
.overlay .cancel {
  position: absolute;
  width: 100%;
  height: 100%;
}
</style>

