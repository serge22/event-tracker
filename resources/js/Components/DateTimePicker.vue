<script setup>
import {mdiCalendar, mdiCheck, mdiClock} from "@mdi/js"
import { ref, computed, watch } from 'vue'
import dayjs from "dayjs";

const model = defineModel()
const props = defineProps({
    fullscreen: {
        type: Boolean,
        default: false
    },
    persistent: {
        type: Boolean,
        default: false
    },
    dateFormat: {
        type: String,
        default: "DD/MM/YYYY"
    },
    timeFormat: {
        type: String,
        default: "HH:mm"
    }
})
defineOptions({
    inheritAttrs: false,
})


const date = ref(null);
const time = ref(null);
const tab = ref(false);
const datetimeDialog = ref(false);

const datetimeFormatted = computed(() => {
    return model.value
        ? dayjs( model.value ).format( `${props.dateFormat} ${props.timeFormat}` )
        : ''
})

watch(datetimeDialog, (val) => {
    // load into separated models as dialog opens
    if (val && model.value) {
        date.value = new Date(model.value)
        time.value = date.value.getHours() + ':' + date.value.getMinutes()
    }
})

function closeDialog() {
    datetimeDialog.value = false;

    const t = time.value.split(':')
    if (t.length === 2) {
        date.value.setHours(t[0], t[1])
    }
    model.value = date.value.toISOString();

    // prevents animate to date tab when closing
    // setTimeout(() => (tab.value = "date"), 300);
}

</script>

<template>
    <v-dialog
        @click:outside="closeDialog"
        v-model="datetimeDialog"
        :persistent="props.persistent"
        width="325px"
        :fullscreen="props.fullscreen"
    >
        <template v-slot:activator="{ props }">
            <v-text-field v-model="datetimeFormatted" v-bind="{ ...props, ...$attrs}" readonly></v-text-field>
        </template>

        <template v-slot:default="{ isActive }">
            <v-card class="t-datetime-picker white">
                <v-toolbar height="36" color="primary" dark flat>
                    <v-tabs v-model="tab" grow height="36">
                        <v-tab href="#date">
                            <v-icon :icon="mdiCalendar"></v-icon>
                        </v-tab>
                        <v-tab href="#time">
                            <v-icon :icon="mdiClock"></v-icon>
                        </v-tab>
                        <v-btn depressed text class="rounded-0" @click="closeDialog">
                            <v-icon :icon="mdiCheck"></v-icon>
                        </v-btn>
                    </v-tabs>
                </v-toolbar>

                <v-tabs-window v-model="tab">
                    <v-tabs-window-item value="date">
                        <v-date-picker v-model="date" class="rounded-0" @input="tab = 'time'" full-width></v-date-picker>
                    </v-tabs-window-item>
                    <v-tabs-window-item value="time">
                        <v-time-picker
                            :key="tab"
                            v-model="time"
                            format="24hr"
                            class="rounded-0"
                            full-width
                            @click:minute="closeDialog"
                        >
                        </v-time-picker>
                    </v-tabs-window-item>
                </v-tabs-window>
            </v-card>
        </template>
    </v-dialog>
</template>
<!--
<style scoped>
.t-datetime-picker {
    .v-tabs-slider-wrapper {
        top: 0;
    }
    .v-picker__title {
        height: 90px;
    }
    .v-time-picker-title__time * {
        font-size: 60px;
        height: 60px;
    }
    .v-picker__body {
        height: 290px;
    }
    .v-tabs-items {
        height: 380px;
    }
}
</style>
-->
