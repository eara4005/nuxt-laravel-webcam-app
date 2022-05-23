<template>
    <v-container pt-4>
        <v-row justify="center">
            <v-cols cols="12" sm="6" md="6">
                <v-card 
                    class="logo py-2 justify-center"
                    min-width="720"
                >
                    <div class="border">
                    <vue-web-cam
                        class="camera"
                        ref="webcam"
                        :device-id="deviceId"
                        width="100%"
                        @started="onStarted"
                        @stopped="onStopped"
                        @error="onError"
                        @cameras="onCameras"
                        @camera-change="onCameraChange"
                    />
                </div>
                </v-card>
                <div class="row">
                    <div class="col-md-12">
                        <h5>▼ 以下からカメラデバイスを選択</h5>
                        <select v-model="camera">
                            <option>-- Select Device --</option>
                            <option
                                v-for="device in devices"
                                :key="device.deviceId"
                                :value="device.deviceId"
                            >{{ device.label }}</option>
                        </select>
                        <v-card-actions>
                            <v-btn
                                color="primary"
                                @click="onCapture"
                            >
                                写真を撮る
                            </v-btn>
                            <v-btn
                                color="error"
                                @click="onStop"
                            >
                                カメラを停止
                            </v-btn>
                            <v-btn
                                color="success"
                                @click="onStart"
                            >
                                カメラを有効化
                            </v-btn>
                        </v-card-actions>
                    </div>
                </div>
            </v-cols>
            <v-cols cols="12" sm="8" md="6">
                <h2>撮った写真</h2>
                <v-card 
                    class="logo py-4S justify-center"
                    min-width="720"
                >
                    <div class="border">
                        <figure class="figure">

                            <v-img 
                                :src="img" 
                                width="100%"
                                class="img-responsive camera" />
                        </figure>
                    </div>
                </v-card>
                <div class="col-md-12">
                    <v-card-actions>
                        <v-btn
                            color="primary"
                            @click="onClickAdd"
                            to=/upload nuxt
                        >
                            アップロード
                        </v-btn>
                    </v-card-actions>
                </div>
            </v-cols>
        </v-row>
    </v-container>
</template>

<script>
import { WebCam } from 'vue-web-cam'
import axios from'axios'

export default {
    name: "CamApp",
    components: {
        "vue-web-cam": WebCam
    },
    data() {
        return {
            img: null,
            camera: null,
            deviceId: null,
            devices: []
        };
    },
    computed: {
        device: function() {
            return this.devices.find(n => n.deviceId === this.deviceId)
        },
    },
    watch: {
        camera: function(id) {
            this.deviceId = id;
        },
        devices: function() {
            // Once we have a list select the first one
            const [first, ...tail] = this.devices;
            if (first) {
                this.camera = first.deviceId;
                this.deviceId = first.deviceId;
            }
        }
    },
    methods: {
        onCapture() {
            this.img = this.$refs.webcam.capture();
            alert("写真が取れました！スクロールして確認してください。")
        },
        onStarted(stream) {
            console.log("On Started Event", stream);
        },
        onStopped(stream) {
            console.log("On Stopped Event", stream);
        },
        onStop() {
            this.$refs.webcam.stop();
        },
        onStart() {
            this.$refs.webcam.start();
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
            const formData = new FormData()

            formData.append("file",this.img)
           
            axios.post('http://localhost:18080/api/upload',formData).then(response => {
                alert('投稿完了')
            })
            
        },
    }
};
</script>
<style scoped>
.camera {
  transform: scale(-1, 1);
}
</style>