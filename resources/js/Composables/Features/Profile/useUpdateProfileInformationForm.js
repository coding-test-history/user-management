import { ref } from 'vue';
import { useForm } from "@inertiajs/vue3";

export default function UpdateProfileInformationForm(props) {
    const verificationLinkSent = ref(null);
    const photoPreview = ref(null);
    const photoInput = ref(null);

    const form = useForm({
        _method: "PUT",
        name: props.user.name,
        email: props.user.email,
        photo: null,
    });

    const updateProfileInformation = () => {
        if (photoInput.value) {
            form.photo = photoInput.value.files[0];
        }

        form.post(route("user-profile-information.update"), {
            errorBag: "updateProfileInformation",
            preserveScroll: true,
            onSuccess: () => clearPhotoFileInput(),
        });
    };

    const sendEmailVerification = () => {
        verificationLinkSent.value = true;
    };

    const selectNewPhoto = () => {
        photoInput.value.click();
    };

    const updatePhotoPreview = () => {
        const photo = photoInput.value.files[0];

        if (!photo) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            photoPreview.value = e.target.result;
        };

        reader.readAsDataURL(photo);
    };

    const deletePhoto = () => {
        router.delete(route("current-user-photo.destroy"), {
            preserveScroll: true,
            onSuccess: () => {
                photoPreview.value = null;
                clearPhotoFileInput();
            },
        });
    };

    const clearPhotoFileInput = () => {
        if (photoInput.value?.value) {
            photoInput.value.value = null;
        }
    };

    return {
        updateProfileInformation,
        sendEmailVerification,
        updatePhotoPreview,
        selectNewPhoto,
        deletePhoto,
        form,
    };
}