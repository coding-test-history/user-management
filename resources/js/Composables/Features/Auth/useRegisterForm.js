import { useForm } from "@inertiajs/vue3";

export default function useRegisterForm() {
    const form = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
    });

    const submit = () => {
        form.post(route("register"), {
            onFinish: () => form.reset("password", "password_confirmation"),
        });
    };

    return { form, submit };
}
