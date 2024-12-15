// vue components
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default function useList() {
    // State untuk menyimpan data pengguna
    const users = ref([]);
    const pagination = ref({
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
    });

    // Form management
    const form = useForm({
        name: "",
        email: "",
        password: "",
        role_id: "",
    });

    // default
    const confirmingUserDeletion = ref(false);
    const selectedUserId = ref(null);
    const openCreateNewUserModal = ref(false);
    const isEditUserModalOpen = ref(false);
    const selectedUser = ref(null);
    const roleValue = ref("");

    // Fungsi untuk memuat data dari API
    const fetchUsers = async (page = 1) => {
        try {
            const response = await axios.get(`/api/user/list?page=${page}`);
            users.value = response.data.data.data;
            pagination.value = {
                current_page: response.data.data.current_page,
                last_page: response.data.data.last_page,
                per_page: response.data.data.per_page,
                total: response.data.data.total,
            };
        } catch (error) {
            console.error("Error fetching users:", error);
        }
    };

    const changePage = (page) => {
        fetchUsers(page);
    };

    const roleOptions = ref([]);

    const fetchRoleOptions = async () => {
        try {
            const response = await axios.get(`/api/user/role-permission?page=1`);
            const roles = response.data.data.data;
            roleOptions.value = roles.map((role) => ({
                label: role.role_name,
                value: role.id,
            }));
        } catch (error) {
            console.error("Error fetching roles:", error);
        }
    };

    // Memuat data saat komponen di-mount
    onMounted(() => {
        fetchUsers();
        fetchRoleOptions();
    });

    // delete user confirmation handler
    const deleteUserConfirmation = (id) => {
        confirmingUserDeletion.value = true;
        selectedUserId.value = id;
    };

    // close modal delete user handler
    const closeModalDeleteUser = () => {
        confirmingUserDeletion.value = false;
    };

    // delete user process
    const deleteUserProcess = async () => {
        try {
            const userId = selectedUserId.value;
            const response = await axios.delete(
                `/api/user/list/delete/${userId}`
            );
            users.value = users.value.filter((user) => user.id !== userId);
            closeModalDeleteUser();
            Swal.fire({
                title: "Deleted!",
                text:
                    response.data.message ||
                    "User has been deleted successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error fetching users:", error);
            Swal.fire({
                title: "Error!",
                text: "There was an error while deleting the user.",
                icon: "error",
                confirmButtonText: "Try Again",
            });
        }
    };

    // create new user modal handler
    const createNewUserModalHandler = (values) => {
        openCreateNewUserModal.value = values;
    };

    // process create user
    const createUserProcess = async () => {
        try {
            const payload = {
                name: form.name,
                email: form.email,
                password: form.password,
                role_id: form.role_id,
            };

            const response = await axios.post("/api/user/list/store", payload);
            users.value.push(response.data.data);
            form.reset();
            createNewUserModalHandler(false);
            Swal.fire({
                title: "Created!",
                text:
                    response.data.message ||
                    "User has been created successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error creating user:", error);
            if (error.response?.data?.errors) {
                form.setError(error.response.data.errors);
            }
        }
    };

    // Buka modal edit user
    const openModalEditUser = (id) => {
        const user = users.value.find((user) => user.id === id);
        if (user) {
            selectedUser.value = user;
            form.name = user.name || "";
            form.email = user.email || "";
            form.role_id = user.role_id || "";
            isEditUserModalOpen.value = true;
        } else {
            console.error(`User with id ${id} not found.`);
        }
    };

    // Tutup modal edit user
    const closeEditUserModal = () => {
        isEditUserModalOpen.value = false;
        form.reset();
    };

    // Proses edit user
    const editUserProcess = async () => {
        if (!selectedUser.value) {
            console.error("No Role selected for editing.");
            return; // Prevent further execution if selectedUser is null/undefined
        }

        try {
            const payload = {
                name: form.name,
                email: form.email,
                role_id: form.role_id,
            };
            const response = await axios.put(
                `/api/user/list/update/${selectedUser.value.id}`, // Ensure id is accessed safely
                payload
            );

            const getCurrentUpdateData = await axios.get(
                `/api/user/list/${selectedUser.value.id}`
            );
            const updatedUser = getCurrentUpdateData.data.data;

            // Perbarui data di tabel
            const index = users.value.findIndex(
                (user) => user.id === updatedUser.id
            );
            if (index !== -1) {
                users.value[index] = updatedUser;
            }

            closeEditUserModal();

            Swal.fire({
                title: "Updated!",
                text:
                    response.data.message ||
                    "User has been updated successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error updating user:", error);
            if (error.response?.data?.errors) {
                form.setError(error.response.data.errors);
            }
        }
    };

    return {
        users,
        fetchUsers,
        openModalEditUser,
        deleteUserConfirmation,
        closeModalDeleteUser,
        confirmingUserDeletion,
        deleteUserProcess,
        openCreateNewUserModal,
        createNewUserModalHandler,
        form,
        createUserProcess,
        isEditUserModalOpen,
        closeEditUserModal,
        editUserProcess,
        selectedUser,
        pagination,
        changePage,
        roleValue,
        roleOptions,
    };
}
