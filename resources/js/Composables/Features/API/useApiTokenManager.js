import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

export function useApiTokenManager(props) {
    const createApiTokenForm = useForm({
        name: "",
        permissions: props.defaultPermissions,
    });

    const updateApiTokenForm = useForm({
        permissions: [],
    });

    const deleteApiTokenForm = useForm({});
    const displayingToken = ref(false);
    const managingPermissionsFor = ref(null);
    const apiTokenBeingDeleted = ref(null);

    const createApiToken = () => {
        createApiTokenForm.post(route("api-tokens.store"), {
            preserveScroll: true,
            onSuccess: () => {
                displayingToken.value = true;
                createApiTokenForm.reset();
            },
        });
    };

    const manageApiTokenPermissions = (token) => {
        updateApiTokenForm.permissions = token.abilities;
        managingPermissionsFor.value = token;
    };

    const updateApiToken = () => {
        updateApiTokenForm.put(
            route("api-tokens.update", managingPermissionsFor.value),
            {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => (managingPermissionsFor.value = null),
            }
        );
    };

    const confirmApiTokenDeletion = (token) => {
        apiTokenBeingDeleted.value = token;
    };

    const deleteApiToken = () => {
        deleteApiTokenForm.delete(
            route("api-tokens.destroy", apiTokenBeingDeleted.value),
            {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => (apiTokenBeingDeleted.value = null),
            }
        );
    };

    return {
        createApiTokenForm,
        updateApiTokenForm,
        deleteApiTokenForm,
        displayingToken,
        managingPermissionsFor,
        apiTokenBeingDeleted,
        createApiToken,
        manageApiTokenPermissions,
        updateApiToken,
        confirmApiTokenDeletion,
        deleteApiToken,
    };
}
