// vue components
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default function useMenu() {
    // State untuk menyimpan data pengguna
    const menus = ref([]);
    const pagination = ref({
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0,
    });

    // Form management
    const form = useForm({
        menu_name: "",
        route: "",
        parent_menu_id: "",
    });

    // default
    const confirmingMenuDeletion = ref(false);
    const selectedMenuId = ref(null);
    const openCreateNewMenuModal = ref(false);
    const isEditMenuModalOpen = ref(false);
    const selectedMenu = ref(null);
    const parentMenuValue = ref("");

    // Fungsi untuk memuat data dari API
    const fetchMenus = async (page = 1) => {
        try {
            const response = await axios.get(`/api/user/menu?page=${page}`);
            menus.value = response.data.data.data;
            pagination.value = {
                current_page: response.data.data.current_page,
                last_page: response.data.data.last_page,
                per_page: response.data.data.per_page,
                total: response.data.data.total,
            };
        } catch (error) {
            console.error("Error fetching menus:", error);
        }
    };

    const changePage = (page) => {
        fetchMenus(page);
    };

    // Memuat data saat komponen di-mount
    onMounted(() => {
        fetchMenus();
    });

    const parentOptions = computed(() => {
        return menus.value.map((menu) => ({
            label: menu.menu_name,
            value: menu.id,
        }));
    });

    // delete menu confirmation handler
    const deleteMenuConfirmation = (id) => {
        confirmingMenuDeletion.value = true;
        selectedMenuId.value = id;
    };

    // close modal delete menu handler
    const closeModalDeleteMenu = () => {
        confirmingMenuDeletion.value = false;
    };

    // delete menu process
    const deleteMenuProcess = async () => {
        try {
            const menuId = selectedMenuId.value;
            const response = await axios.delete(
                `/api/user/menu/delete/${menuId}`
            );
            menus.value = menus.value.filter((menu) => menu.id !== menuId);
            closeModalDeleteMenu();
            Swal.fire({
                title: "Deleted!",
                text:
                    response.data.message ||
                    "Menu has been deleted successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error fetching menus:", error);
            Swal.fire({
                title: "Error!",
                text: "There was an error while deleting the menu.",
                icon: "error",
                confirmButtonText: "Try Again",
            });
        }
    };

    // create new menu modal handler
    const createNewMenuModalHandler = (values) => {
        openCreateNewMenuModal.value = values;
    };

    // process create menu
    const createMenuProcess = async () => {
        try {
            const payload = {
                menu_name: form.menu_name,
                route: form.route,
                parent_menu_id: form.parent_menu_id,
            };

            const response = await axios.post("/api/user/menu/store", payload);
            menus.value.push(response.data.data);
            form.reset();
            createNewMenuModalHandler(false);
            Swal.fire({
                title: "Created!",
                text:
                    response.data.message ||
                    "Menu has been created successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error creating menu:", error);
            if (error.response?.data?.errors) {
                form.setError(error.response.data.errors);
            }
        }
    };

    // Buka modal edit menu
    const openModalEditMenu = (id) => {
        const menu = menus.value.find((menu) => menu.id === id);
        if (menu) {
            selectedMenu.value = menu;
            form.menu_name = menu.menu_name || "";
            form.route = menu.route || "";
            form.parent_menu_id = menu.parent_menu_id || "";
            isEditMenuModalOpen.value = true;
        } else {
            console.error(`Menu with id ${id} not found.`);
        }
    };

    // Tutup modal edit menu
    const closeEditMenuModal = () => {
        isEditMenuModalOpen.value = false;
        form.reset();
    };

    // Proses edit menu
    const editMenuProcess = async () => {
        if (!selectedMenu.value) {
            console.error("No menu selected for editing.");
            return; // Prevent further execution if selectedMenu is null/undefined
        }

        try {
            const payload = {
                menu_name: form.menu_name,
                route: form.route,
                parent_menu_id: form.parent_menu_id,
            };
            const response = await axios.put(
                `/api/user/menu/update/${selectedMenu.value.id}`, // Ensure id is accessed safely
                payload
            );

            const getCurrentUpdateData = await axios.get(
                `/api/user/menu/${selectedMenu.value.id}`
            );
            const updatedMenu = getCurrentUpdateData.data.data;

            // Perbarui data di tabel
            const index = menus.value.findIndex(
                (menu) => menu.id === updatedMenu.id
            );
            if (index !== -1) {
                menus.value[index] = updatedMenu;
            }

            closeEditMenuModal();

            Swal.fire({
                title: "Updated!",
                text:
                    response.data.message ||
                    "Menu has been updated successfully.",
                icon: "success",
                confirmButtonText: "OK",
                background: "#1f2937",
                color: "#fff",
                confirmButtonColor: "#1e40af",
            });
        } catch (error) {
            console.error("Error updating menu:", error);
            if (error.response?.data?.errors) {
                form.setError(error.response.data.errors);
            }
        }
    };

    return {
        menus,
        fetchMenus,
        openModalEditMenu,
        deleteMenuConfirmation,
        closeModalDeleteMenu,
        confirmingMenuDeletion,
        deleteMenuProcess,
        openCreateNewMenuModal,
        createNewMenuModalHandler,
        form,
        createMenuProcess,
        isEditMenuModalOpen,
        closeEditMenuModal,
        editMenuProcess,
        selectedMenu,
        pagination,
        changePage,
        parentMenuValue,
        parentOptions,
    };
}
