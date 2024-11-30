import { ref } from "vue";

export default function useDeleteUserForm(form, passwordInput) {
    const confirmingUserDeletion = ref(false);

    const confirmUserDeletion = () => {
        confirmingUserDeletion.value = true; // Periksa apakah ini dijalankan
        setTimeout(() => passwordInput.value.focus(), 250);
    };

    const deleteUser = () => {
        form.delete(route("current-user.destroy"), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.value.focus(),
            onFinish: () => form.reset(),
        });
    };

    const closeModal = () => {
        confirmingUserDeletion.value = false;

        form.reset();
    };

    return {
        confirmingUserDeletion,
        confirmUserDeletion,
        deleteUser,
        closeModal,
    };
}
