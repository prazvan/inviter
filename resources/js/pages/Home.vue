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

                    <a class="btn btn-primary align-center" href="#" role="button"
                       @click="fetchInvitees">Check current records.</a>
                    <a class="btn btn-success align-center" href="#" role="button" @click="reset">New Upload</a>
                    <hr>
                </div>

                <div class="alert alert-danger" role="alert" v-if="error">
                    Sorry, there seems to be an issue, Reloading page in {{reloadCounter}} seconds
                </div>



                <vue-dropzone v-if="!hideUpload && !error"
                              ref="upload"
                              id="dropzone_upload_homepage"
                              class="mb-sm-5"
                              :options="this.dropzoneOptions"
                              :useCustomSlot="true"
                              :includeStyling="true"
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

                <div v-if="showLists">
                    <div v-if="inviteesWhitelist.length > 0">
                        <h2 class="mt-5">Invitees on the Whitelist</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Affiliate ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Distance (in KM)</th>
                                <th scope="col">Coordinates</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in inviteesWhitelist">
                                <th scope="row">{{ item.id }}</th>
                                <td>{{ item.affiliate_id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.distance }} KM</td>
                                <td>{{ item.latitude }}, {{ item.longitude }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                    </div>

                    <div v-if="inviteesBlacklist.length > 0">
                        <h2 class="mt-5">Invitees on the BlackList</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Affiliate ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Distance (in KM)</th>
                                <th scope="col">Coordinates</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in inviteesBlacklist">
                                <th scope="row">{{ item.id }}</th>
                                <td>{{ item.affiliate_id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.distance }} KM</td>
                                <td>{{ item.latitude }}, {{ item.longitude }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

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

        // reload counter
        reloadCounter: 5,
        error: false,
        hideUpload: false,
        showLists: false,

        inviteesWhitelist:[],
        inviteesBlacklist:[],

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

        upload(response)
        {

            if (response.status === 'success')
            {
                this.fetchInvitees();
            }
            else
            {
                // set error to true and reload page in 5 seconds
                this.error = true;

                // reload the page after 5 sec
                setTimeout(() => (window.location.reload(true)), 5000);

                // countdown from 5
                setInterval(() => (this.reloadCounter -= 1), 1000);
            }
        },

        /**
         * Fetch Invitees
         *
         * @returns {Promise<void>}
         */
        async fetchInvitees()
        {
            // hide upload
            this.hideUpload = true;

            // whitelist & blacklist
            const whitelist = axios.get('/api/invitees/whitelist');
            const blacklist = axios.get('/api/invitees/blacklist');

            // fetch data
            await axios.all([whitelist, blacklist]).then(
                axios.spread((...responses) => {
                    this.inviteesWhitelist = responses[0].data.items;
                    this.inviteesBlacklist = responses[1].data.items;
                    this.showLists = true;
                })
            );
        },

        reset()
        {
            this.error = false;
            this.hideUpload = false;
            this.showLists = false;
            this.inviteesWhitelist = [];
            this.inviteesBlacklist = [];
        }
    },
}
</script>
