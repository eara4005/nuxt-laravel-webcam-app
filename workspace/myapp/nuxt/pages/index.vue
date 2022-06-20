<template>
  <v-container pt-4>
    <v-row justify="center">
      <v-col cols="12" sm="6" md="6">
        <v-card class="logo py-2 justify-center" min-width="720">
          <div class="border">
            <vue-web-cam class="camera" ref="webcam" :device-id="deviceId" width="100%" @error="onError"
              @cameras="onCameras" @camera-change="onCameraChange" />
          </div>
        </v-card>
        <div class="row">
          <div class="col-md-12 my-4">
            <h5>▼ 以下からカメラデバイスを選択</h5>
            <select v-model="camera">
              <option>-- Select Device --</option>
              <option v-for="device in devices" :key="device.deviceId" :value="device.deviceId">{{
                  device.label
              }}</option>
            </select>
            <h4 class="my-4">ログインユーザー</h4>
            <h2 ref="username">{{ userName }}</h2>
            <v-card-actions class="my-4">
              <v-btn color="success" @click="onCapture">
                写真を撮る
                <v-icon>
                  mdi-camera
                </v-icon>
              </v-btn>
            </v-card-actions>
          </div>
        </div>
        <v-card class="logo py-4S justify-center" min-width="720">
          <div class="border">
            <figure class="figure">
              <v-img :src="img" width="100%" class="img-responsive camera" />
            </figure>
          </div>
        </v-card>
        <v-card-actions>
          <v-btn :disabled="!img" color="primary" @click="onClickAdd" to="/upload" nuxt>アップロード
            <v-icon>
              mdi-cloud-upload
            </v-icon>
          </v-btn>
        </v-card-actions>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { WebCam } from 'vue-web-cam'
import axios from 'axios'

export default {
  middleware: 'auth',
  name: "CamApp",
  components: {
    "vue-web-cam": WebCam
  },
  data() {
    return {
      img: null,
      btn: null,
      camera: null,
      deviceId: null,
      devices: [],
      username: '',
    };

  },
  computed: {
    device: function () {
      return this.devices.find(n => n.deviceId === this.deviceId)
    },

  },
  watch: {
    camera: function (id) {
      this.deviceId = id;
    },
    devices: function () {
      // Once we have a list select the first one
      const [first, ...tail] = this.devices;
      if (first) {
        this.camera = first.deviceId;
        this.deviceId = first.deviceId;
      }
    }
  },

  async asyncData(app) {
    const resData = await app.$axios.$get('http://localhost:18080/api/current_user');
    const userName = resData.name;
    return {
      userName,
    }
  },

  methods: {
    onCapture() {
      this.img = this.$refs.webcam.capture();
      // ユーザー名取得
      const targetElementText = this.$refs.username.textContent
      this.username = targetElementText
      console.log(this.username);
      alert("写真が取れました！スクロールして確認してください。")
    },
    onError(error) {
      console.log("On Error Event", error);
    },
    onCameras(cameras) {
      this.devices = cameras;
      console.log("On Cameras Event", cameras);
    },
    onCameraChange(deviceId) {
      this.deviceId = deviceId;
      this.camera = deviceId;
      console.log("On Camera Change Event", deviceId);
    },
    async onClickAdd() {
      const formData = new FormData();

      formData.append("img", this.img);
      formData.append("name", this.username);

      await axios.post('http://localhost:18080/api/upload', formData)
        .then(response => {
          console.log("Picture upload done.")
        })
        .catch(response => {
          alert('送信に失敗しました。')
        });
    },
  }
};
</script>
<style scoped>
.camera {
  transform: scale(-1, 1);
}
</style>