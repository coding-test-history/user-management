import { ref, computed, watch } from "vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import axios from "axios";

export function useTwoFactorAuthenticationForm() {
    const page = usePage();
    const enabling = ref(false);
    const confirming = ref(false);
    const disabling = ref(false);
    const qrCode = ref(null);
    const setupKey = ref(null);
    const recoveryCodes = ref([]);
    const confirmationForm = useForm({ code: "" });

    const twoFactorEnabled = computed(
        () => !enabling.value && page.props.auth.user?.two_factor_enabled
    );

    watch(twoFactorEnabled, () => {
        if (!twoFactorEnabled.value) {
            confirmationForm.reset();
            confirmationForm.clearErrors();
        }
    });

    const enableTwoFactorAuthentication = () => {
        enabling.value = true;

        router.post(
            route("two-factor.enable"),
            {},
            {
                preserveScroll: true,
                onSuccess: () =>
                    Promise.all([
                        showQrCode(),
                        showSetupKey(),
                        showRecoveryCodes(),
                    ]),
                onFinish: () => {
                    enabling.value = false;
                    confirming.value = true;
                },
            }
        );
    };

    const disableTwoFactorAuthentication = () => {
        disabling.value = true;

        router.delete(route("two-factor.disable"), {
            preserveScroll: true,
            onSuccess: () => {
                disabling.value = false;
                confirming.value = false;
            },
        });
    };

    const regenerateRecoveryCodes = () => {
        axios
            .post(route("two-factor.recovery-codes"))
            .then(() => showRecoveryCodes());
    };

    const showQrCode = () =>
        axios.get(route("two-factor.qr-code")).then((response) => {
            qrCode.value = response.data.svg;
        });

    const showSetupKey = () =>
        axios.get(route("two-factor.secret-key")).then((response) => {
            setupKey.value = response.data.secretKey;
        });

    const showRecoveryCodes = () =>
        axios.get(route("two-factor.recovery-codes")).then((response) => {
            recoveryCodes.value = response.data;
        });

    const confirmTwoFactorAuthentication = () => {
        confirmationForm.post(route("two-factor.confirm"), {
            errorBag: "confirmTwoFactorAuthentication",
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                confirming.value = false;
                qrCode.value = null;
                setupKey.value = null;
            },
        });
        console.log(confirmationForm);
    };

    return {
        enabling,
        confirming,
        disabling,
        qrCode,
        setupKey,
        recoveryCodes,
        confirmationForm,
        twoFactorEnabled,
        enableTwoFactorAuthentication,
        disableTwoFactorAuthentication,
        regenerateRecoveryCodes,
        showQrCode,
        showSetupKey,
        showRecoveryCodes,
        confirmTwoFactorAuthentication,
    };
}
