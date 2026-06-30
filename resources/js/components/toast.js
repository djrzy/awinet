export default () => ({
    toast: false,
    toastTitle: "",
    toastMessage: "",
    toastType: "success",
    toastTimeout: null,

    showToast(event) {
        if (!event.detail?.title) return;

        clearTimeout(this.toastTimeout);

        this.toast = true;
        this.toastTitle = event.detail.title;
        this.toastMessage = event.detail.message || "";
        this.toastType = event.detail.type || "success";

        this.toastTimeout = setTimeout(() => {
            this.toast = false;
        }, 3000);
    },
});
