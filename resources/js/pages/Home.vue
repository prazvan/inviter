<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="lead">
                    <h1>Welcome to Inviter.com</h1>
                    <p>
                        Inviter.com is a SPA application that let's you upload a list with affiliate information <br>
                        and send emails to all of them so they can come to the amazing party you're organazing :)
                    </p>
                    <hr>
                </div>
                <vue-dropzone ref="upload"
                              id="dropzone_upload_homepage"
                              class="mb-sm-5"
                              :options="this.dropzoneOptions"
                              :useCustomSlot="true"
                              :includeStyling="true"
                              @vdropzone-file-added="this.fileAdded"
                              @vdropzone-complete="this.upload"
                >
                    <div class="dropzone-custom-content">
                        <h2 class="dropzone-custom-title">Get starded.</h2>
                        <div class="subtitle">
                            drag & drop the file into the upload area.<br/>
                            Or click to select a file from your computer
                        </div>
                    </div>
                </vue-dropzone>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

export default {


    components: {
        vueDropzone: vue2Dropzone
    },

    data: () => ({
        dropzoneOptions: {
            url: '/api/upload',
            thumbnailWidth: 300,
            maxFilesize: 0.5,
            uploadMultiple: false,
            // acceptedFiles: ['.txt'],
            autoProcessQueue: true,
            autoQueue: true,
        }
    }),

    methods:{

        fileAdded(event) {

            return true
        },



        upload(response)
        {
            console.log(response);
        }

    },

    mounted() {

    }

}
</script>
