import { ref } from "vue";

export default function useLogoutOtherBrowserSessionsForm(form, passwordInput) {
    const confirmingLogout = ref(false);
    
    const confirmLogout = () => {
        confirmingLogout.value = true;

        setTimeout(() => passwordInput.value.focus(), 250);
    };

    const logoutOtherBrowserSessions = () => {
        form.delete(route("other-browser-sessions.destroy"), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.value.focus(),
            onFinish: () => form.reset(),
        });
    };

    const closeModal = () => {
        confirmingLogout.value = false;

        form.reset();
    };
    return {
        confirmingLogout,
        confirmLogout,
        logoutOtherBrowserSessions,
        closeModal,
    };
}
