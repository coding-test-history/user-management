import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

export default function useForgotPassword() {
    const form = useForm({
        password: "",
    });

    const passwordInput = ref(null);

    const submit = () => {
        form.post(route("password.confirm"), {
            onFinish: () => {
                form.reset();

                passwordInput.value.focus();
            },
        });
    };

    return { form, passwordInput, submit };
}
