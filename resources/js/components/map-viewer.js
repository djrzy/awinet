export default function mapViewer(config = {}) {
    return {
        map: null,

        markers: [],

        id: config.id,

        options: {
            zoom: config.zoom ?? 17,

            indonesiaZoom: config.indonesiaZoom ?? 5,

            maxZoom: config.maxZoom ?? 19,

            indonesiaCenter: {
                lat: config.indonesiaLat ?? -2.548926,
                lng: config.indonesiaLng ?? 118.0148634,
            },

            tileUrl:
                config.tileUrl ??
                "https://tile.openstreetmap.org/{z}/{x}/{y}.png",
        },

        init() {
            if (this.map) return;

            const incomingMarkers = config.markers ?? [];

            const hasMarkers = incomingMarkers.length > 0;

            const initialCenter = hasMarkers
                ? [
                      Number(incomingMarkers[0].lat),
                      Number(incomingMarkers[0].lng),
                  ]
                : [
                      this.options.indonesiaCenter.lat,
                      this.options.indonesiaCenter.lng,
                  ];

            const initialZoom = hasMarkers
                ? this.options.zoom
                : this.options.indonesiaZoom;

            this.map = L.map(this.$refs.map).setView(
                initialCenter,
                initialZoom,
            );

            L.tileLayer(this.options.tileUrl, {
                maxZoom: this.options.maxZoom,
            }).addTo(this.map);

            this.setMarkers(incomingMarkers);

            this.bindRefreshListener();

            this.refresh();
        },

        bindRefreshListener() {
            window.addEventListener("refresh-map", (event) => {
                if (event.detail?.id !== this.id) {
                    return;
                }

                this.refresh();
            });
        },

        refresh() {
            this.$nextTick(() => {
                requestAnimationFrame(() => {
                    if (!this.map) return;

                    this.map.invalidateSize();

                    if (this.markers.length > 0) {
                        this.fitMarkers();
                    }
                });
            });
        },

        setMarkers(markers = []) {
            this.clearMarkers();

            markers.forEach((markerData) => {
                if (markerData.lat == null || markerData.lng == null) {
                    return;
                }

                const marker = L.marker(
                    [Number(markerData.lat), Number(markerData.lng)],
                    {
                        icon: this.getMarkerIcon(markerData.status),
                    },
                ).addTo(this.map);

                if (markerData.popup) {
                    marker.bindPopup(markerData.popup);
                }

                this.markers.push(marker);
            });

            this.fitMarkers();
        },

        fitMarkers() {
            if (!this.markers.length) {
                return;
            }

            if (this.markers.length === 1) {
                this.map.setView(
                    this.markers[0].getLatLng(),
                    this.options.zoom,
                );

                return;
            }

            const bounds = L.latLngBounds(
                this.markers.map((marker) => marker.getLatLng()),
            );

            this.map.fitBounds(bounds, {
                padding: [50, 50],
            });
        },

        clearMarkers() {
            this.markers.forEach((marker) => {
                this.map.removeLayer(marker);
            });

            this.markers = [];
        },

        focus(lat, lng, zoom = null) {
            if (!this.map) return;

            this.map.flyTo(
                [Number(lat), Number(lng)],
                zoom ?? this.options.zoom,
            );
        },

        getMarkerIcon(status) {
            const markerColor = {
                active: "green",
                suspended: "red",
                pending: "gold",
                terminated: "grey",
            };

            const color = markerColor[status] ?? "blue";

            return new L.Icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,

                shadowUrl:
                    "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",

                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41],
            });
        },
    };
}
