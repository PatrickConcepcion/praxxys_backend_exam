<template>
    <div class="container">
      <div class="text-center">
          <video-player v-if="ready" :options="videoOptions" id="video-player" />
      </div>
      <div class="form-group">
        <label>Please pick a video you want to watch</label>
        <select class="form-select" v-model="video_source" @change="changeVideo">
            <option value="/videos/zumba.mp4">Zumba</option>
            <option value="">Tawi Tawi</option>
        </select>
      </div>
    </div>
</template>
  
<script>
  import VideoPlayer from '@/components/VideoPlayer.vue';
  
  export default {
    name: 'Videos Link',
    components: {
      VideoPlayer
    },
    data() {
      return {
        ready: true,
        video_source: '',
        videoOptions: {
          autoplay: false,
          controls: true,
          sources: [
            {
              src: '',
              type: 'video/mp4'
            }
          ]
        }
      }
    },
    methods: {
        changeVideo() {
            this.videoOptions['sources'] = {
                src: '/videos/zumba.mp4'
            }
        }
    },
    created() {
        this.changeVideo()
    }
  };
  </script>