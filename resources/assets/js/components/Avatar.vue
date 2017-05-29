<template>
    <div>
        <my-upload field="avatar"
                   @crop-success="cropSuccess"
                   @crop-upload-success="cropUploadSuccess"
                   @crop-upload-fail="cropUploadFail"
                   v-model="show"
                   :width="120"
                   :height="120"
                   url="/dashboard/saveavatar"
                   :params="params"
                   :headers="headers"
                   img-format="png"></my-upload>
        <label class="col-sm-2 control-label">
            <a class="btn btn-info" @click="toggleShow">设置图像</a>
        </label>
        <div class="col-sm-9">
            <input type="text" name="avatar" value="" v-model="avatar" hidden/>
            <img :src="imgDataUrl" style="width: 80px;">
        </div>
    </div>
</template>
<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    export default{
        props:['avatars'],
        data(){
            return{
                show: false,
                params: {
                    _token: Laravel.csrfToken,
                    name: 'avatar'
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: this.avatars, // the datebase64 url of created image
                avatar:this.avatars,
            }
        },
        components: {
            'my-upload': myUpload
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(jsonData, field){
                this.avatar =jsonData.url;
                this.show = !this.show;
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        }
    }

</script>
