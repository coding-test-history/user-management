import { computed } from 'vue';
import { useForm } from "@inertiajs/vue3";

export default function useVerifyEmail(props) {
    const form = useForm({});

    const submit = () => {
        form.post(route("verification.send"));
    };

    const verificationLinkSent = computed(
        () => props.status === "verification-link-sent"
    );

    return { form, verificationLinkSent, submit };
}
