import { ref, nextTick } from "vue";
import { useForm } from "@inertiajs/vue3";

export default function useTwoFactorChallenge() {
    const recovery = ref(false);

    const form = useForm({
        code: "",
        recovery_code: "",
    });

    const recoveryCodeInput = ref(null);
    const codeInput = ref(null);

    const toggleRecovery = async () => {
        recovery.value ^= true;

        await nextTick();

        if (recovery.value) {
            recoveryCodeInput.value.focus();
            form.code = "";
        } else {
            codeInput.value.focus();
            form.recovery_code = "";
        }
    };

    const submit = () => {
        form.post(route("two-factor.login"));
    };

    return {
        recovery,
        form,
        recoveryCodeInput,
        codeInput,
        toggleRecovery,
        submit,
    };
}
