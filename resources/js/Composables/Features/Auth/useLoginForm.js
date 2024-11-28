import { useForm } from "@inertiajs/vue3";

export default function useLoginForm() {
    const form = useForm({
        email: "",
        password: "",
        remember: false,
    });

    const submit = () => {
        form.transform((data) => ({
            ...data,
            remember: form.remember ? "on" : "",
        })).post(route("login"), {
            onFinish: () => form.reset("password"),
        });
    };

    return { form, submit };
}
