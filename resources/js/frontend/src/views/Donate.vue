<template>
    <div>
        <modal :show.sync="modals.isVisible">
            <template slot="header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            </template>
            <div>
                Do you want to continue?
            </div>
            <template slot="footer">
                <base-button type="secondary" @click="modals.modal0 = false"
                    >Close</base-button
                >
                <base-button type="primary" @click="redirect">Yes,Continue</base-button>
            </template>
        </modal>
        <div class="h-auto">
            <h1 class="mt-5 mb-4 text-center">Scan QR Code<br />to donate</h1>
            <div class="px-5">
                <div class="border border-dark shadow">
                    <qrcode-stream
                        class="border border-solid"
                        @decode="onDecode"
                    ></qrcode-stream>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { QrcodeStream } from "../../node_modules/vue-qrcode-reader";

export default {
    name: "Donate",
    components: {
        QrcodeStream
    },
    data() {
        return {
            modals: {
                isVisible: false
            }
        };
    },
    methods: {
        onDecode(decodedString) {
            if (!isNaN(decodedString)) {
                this.modals.isVisible = true;
                this.modals.id=decodedString;
            }
        },
        redirect() {
            this.$router.push({
                name: "profile",
                params: { id: this.modals.id }
            });
        }
    }
};
</script>
<style></style>
