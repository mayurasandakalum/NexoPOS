import { defineAsyncComponent } from 'vue';

window[ 'nsIncompleteSaleCardWidget' ]      =   defineAsyncComponent( () => import( './widgets/ns-incomplete-sale-card-widget.vue' ) );
window[ 'nsProfileWidget' ]                 =   defineAsyncComponent( () => import( './widgets/ns-profile-widget.vue' ) );