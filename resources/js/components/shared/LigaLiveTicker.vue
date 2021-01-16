<template>
  <div>
    <div class="container mx-auto text-center flex flex-col my-4">
      <div class="bg-red-500 p-4 rounded-lg shadow-md" v-if="fehlerkz">{{ meldung }}</div>
      <div class="bg-green-500 p-4 rounded-lg shadow-md" v-if="!fehlerkz">
        <div class="bg-black text-center my-2 rounded" v-if="spielminute>9">
          <div class="bg-red-500 p-1 rounded-l" :style="'width:' + (spielminute*100/90) + '%'">
            <span class="text-sm">{{ spielminute }} Minute</span>
          </div>
        </div>
        <div class="flex -mx-2 mt-8" >
            <div class="w-2/5 mx-2 bg-gray-300 p-2 rounded-lg shadow-md text-left text-sm" v-html="ergebnisse"></div>
            
            <div class="w-3/5 mx-2 bg-gray-300 p-2 rounded-lg shadow-md text-left overflow-y-auto h-liveticker">
            <div
                class="text-base text-medium p-1"
                v-for="(torchance, index) in torchancen"
                :key="index"
            >
                <div v-html="torchance"></div>
            </div>
            </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    saisonname: {
      type: String,
      default: "unbekannt"
    },
    liganame: {
      type: String,
      default: "unbekannt"
    },
    spieltagname: {
      type: String,
      default: "unbekannt"
    },
    heimname: {
      type: String,
      default: "unbekannt"
    },
    gastname: {
      type: String,
      default: "unbekannt"
    }
  },

  data() {
    return {
      meldung: null,
      fehlerkz: false,
      spielminute: 0,
      torchancen: [],
      ergebnisse: null,
    };
  },

  created() {
    window.Echo.channel("ligaliveticker").listen("LigaLiveTicker", e => {
      console.log("VUE-Komponente LigaLiveTicker -> Event LigaLiveTicker", e);
      let chance = null;
      chance = e.spielereignis;

      this.spielminute = e.spielminute;

      if (chance !== null) {
        console.log("chance ist ungleich null: ", chance);
        this.torchancen.unshift(chance);
      }

      this.ergebnisse = e.spielergebnis;
    });
  }
};
</script>

