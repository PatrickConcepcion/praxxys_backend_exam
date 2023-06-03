<template>
    <div>
      <video ref="videoPlayer" class="video-js player"></video>
    </div>
</template>
  
<script>
  import videojs from 'video.js';
  import 'video.js/dist/video-js.css'
  
  export default {
    name: 'VideoPlayer',
    props: {
      options: {
        type: Object,
        default() {
          return {};
        }
      }
    },
    data() {
      return {
        player: null
      }
    },
    mounted() {
      this.player = videojs(this.$refs.videoPlayer, this.options, () => {
        this.player.log('onPlayerReady', this);
      });
    },
    beforeDestroy() {
      if (this.player) {
        this.player.dispose();
      }
    }
  }
</script>

<style scoped>
    .player {
        width: 100%;
        max-width: 600px;
        max-height: 400px;
    }
</style>