import { useForm } from "@inertiajs/vue3";

export default function useForgotPassword() {
    const form = useForm({
        email: "",
    });

    const submit = () => {
        form.post(route("password.email"));
    };

    return { form, submit };
}
