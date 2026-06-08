export default function mapPicker(config = {}) {
    return {
        map: null,
        marker: null,

        id: config.id,

        lat: config.lat ?? null,
        lng: config.lng ?? null,

        options: {
            zoom: config.zoom ?? 17,

            indonesiaZoom: config.indonesiaZoom ?? 4,

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

            const hasCoordinate = this.lat != null && this.lng != null;

            const initialLat = hasCoordinate
                ? Number(this.lat)
                : this.options.indonesiaCenter.lat;

            const initialLng = hasCoordinate
                ? Number(this.lng)
                : this.options.indonesiaCenter.lng;

            const initialZoom = hasCoordinate
                ? this.options.zoom
                : this.options.indonesiaZoom;

            this.map = L.map(this.$refs.map).setView(
                [initialLat, initialLng],
                initialZoom,
            );

            L.tileLayer(this.options.tileUrl, {
                maxZoom: this.options.maxZoom,
            }).addTo(this.map);

            if (hasCoordinate) {
                this.setMarker(initialLat, initialLng);
            }

            this.bindMapEvent();

            this.bindRefreshListener();

            this.refresh();
        },

        bindMapEvent() {
            this.map.on("click", (e) => {
                this.updateCoordinate(e.latlng.lat, e.latlng.lng);
            });
        },

        bindRefreshListener() {
            window.addEventListener("refresh-map", (event) => {
                if (event.detail?.id !== this.id) {
                    return;
                }

                const clear = event.detail?.clear ?? false;

                if (clear) {
                    this.clearMarker();
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

                    if (this.marker) {
                        this.map.panTo(this.marker.getLatLng());
                    }
                });
            });
        },

        updateCoordinate(lat, lng) {
            this.lat = lat;
            this.lng = lng;

            this.setMarker(lat, lng);

            this.map.panTo([lat, lng]);
        },

        setMarker(lat, lng) {
            if (!this.marker) {
                this.marker = L.marker([lat, lng], {
                    draggable: true,
                }).addTo(this.map);

                this.marker.on("dragend", (e) => {
                    const position = e.target.getLatLng();

                    this.updateCoordinate(position.lat, position.lng);
                });

                return;
            }

            this.marker.setLatLng([lat, lng]);
        },

        clearMarker() {
            if (this.marker) {
                this.map.removeLayer(this.marker);
                this.marker = null;
            }

            this.lat = null;
            this.lng = null;

            this.map.setView(
                [
                    this.options.indonesiaCenter.lat,
                    this.options.indonesiaCenter.lng,
                ],
                this.options.indonesiaZoom,
            );
        },
    };
}
