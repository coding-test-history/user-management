// vue components
import { ref, onMounted } from "vue";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default function useRole() {
    // State untuk menyimpan data role
    const roles = ref([]);
    const pagination = ref({
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
    });

    // Form management
    const form = useForm({
        role_name: "",
        menu_id: "",
    });

    // default
    const confirmingRoleDeletion = ref(false);
    const selectedRoleId = ref(null);
    const openCreateNewRoleModal = ref(false);
    const isEditRoleModalOpen = ref(false);
    const selectedRole = ref(null);

    // Fungsi untuk memuat data dari API
    const fetchRoles = async (page = 1) => {
        try {
            const response = await axios.get(`/api/user/role-permission?page=${page}`);
            roles.value = response.data.data.data;
            pagination.value = {
                current_page: response.data.data.current_page,
                last_page: response.data.data.last_page,
                per_page: response.data.data.per_page,
                total: response.data.data.total,
            };
        } catch (error) {
            console.error("Error fetching roles:", error);
        }
    };

    const changePage = (page) => {
        fetchRoles(page);
    };

    // Memuat data saat komponen di-mount
    onMounted(() => {
        fetchRoles();
    });

    // delete roles confirmation handler
    const deleteRoleConfirmation = (id) => {
        confirmingRoleDeletion.value = true;
        selectedRoleId.value = id;
    };

    // close modal delete role handler
    const closeModalDeleteRole = () => {
        confirmingRoleDeletion.value = false;
    };

    // delete roles process
    const deleteRoleProcess = async () => {
        try {
            const roleId = selectedRoleId.value;
            const response = await axios.delete(
                `/api/user/role-permission/delete/${roleId}`
            );
            roles.value = roles.value.filter((role) => role.id !== roleId);
            closeModalDeleteRole();
            Swal.fire({
                title: "Deleted!",
                text:
                    response.data.message ||
                    "Role has been deleted successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error fetching roles:", error);
            Swal.fire({
                title: "Error!",
                text: "There was an error while deleting the role.",
                icon: "error",
                confirmButtonText: "Try Again",
            });
        }
    };

    // create new role modal handler
    const createNewRoleModalHandler = (values) => {
        openCreateNewRoleModal.value = values;
    };

    // process create role
    const createRoleProcess = async () => {
        try {
            const payload = {
                role_name: form.role_name,
                menu_id: form.menu_id,
            };

            const response = await axios.post("/api/user/role-permission/store", payload);
            roles.value.push(response.data.data);
            form.reset();
            createNewRoleModalHandler(false);
            Swal.fire({
                title: "Created!",
                text:
                    response.data.message ||
                    "Role has been created successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error creating role:", error);
            if (error.response?.data?.errors) {
                form.setError(error.response.data.errors);
            }
        }
    };

    // Buka modal edit role
    const openModalEditRole = (id) => {
        const role = roles.value.find((role) => role.id === id);
        if (role) {
            selectedRole.value = role;
            form.role_name = role.role_name || "";
            form.menu_id = role.menu_id || "";
            isEditRoleModalOpen.value = true;
        } else {
            console.error(`Role with id ${id} not found.`);
        }
    };

    // Tutup modal edit role
    const closeEditRoleModal = () => {
        isEditRoleModalOpen.value = false;
        form.reset();
    };

    // Proses edit role
    const editRoleProcess = async () => {
        if (!selectedRole.value) {
            console.error("No role selected for editing.");
            return; // Prevent further execution if selectedRole is null/undefined
        }

        try {
            const payload = {
                role_name: form.role_name,
                menu_id: form.menu_id,
            };
            const response = await axios.put(
                `/api/user/role-permission/update/${selectedRole.value.id}`, // Ensure id is accessed safely
                payload
            );

            const getCurrentUpdateData = await axios.get(
                `/api/user/role-permission/${selectedRole.value.id}`
            );
            const updatedRole = getCurrentUpdateData.data.data;

            // Perbarui data di tabel
            const index = roles.value.findIndex(
                (role) => role.id === updatedRole.id
            );
            if (index !== -1) {
                roles.value[index] = updatedRole;
            }

            closeEditRoleModal();

            Swal.fire({
                title: "Updated!",
                text:
                    response.data.message ||
                    "Role has been updated successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error updating role:", error);
            if (error.response?.data?.errors) {
                form.setError(error.response.data.errors);
            }
        }
    };

    return {
        roles,
        fetchRoles,
        openModalEditRole,
        deleteRoleConfirmation,
        closeModalDeleteRole,
        confirmingRoleDeletion,
        deleteRoleProcess,
        openCreateNewRoleModal,
        createNewRoleModalHandler,
        form,
        createRoleProcess,
        isEditRoleModalOpen,
        closeEditRoleModal,
        editRoleProcess,
        selectedRole,
        pagination,
        changePage
    };
}
