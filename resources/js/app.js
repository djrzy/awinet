import "./bootstrap";

import L from "leaflet";
import "leaflet/dist/leaflet.css";

window.L = L;

import markerIcon2x from "leaflet/dist/images/marker-icon-2x.png";
import markerIcon from "leaflet/dist/images/marker-icon.png";
import markerShadow from "leaflet/dist/images/marker-shadow.png";

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});

/**
 * Reusable Toast Component
 */
document.addEventListener("alpine:init", () => {
    Alpine.data("toast", () => ({
        toast: false,
        toastTitle: "",
        toastMessage: "",
        toastTimeout: null,

        showToast(event) {
            if (!event.detail?.title) return;

            clearTimeout(this.toastTimeout);

            this.toast = true;
            this.toastTitle = event.detail.title;
            this.toastMessage = event.detail.message;

            this.toastTimeout = setTimeout(() => {
                this.toast = false;
            }, 3000);
        },
    }));
});
