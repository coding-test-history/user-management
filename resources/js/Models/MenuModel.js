// general props
export const generalProps = {
    title: {
        type: String,
        default: "User",
    },
};

// delete props
export const deleteProps = {
    confirmingMenuDeletion: Boolean,
    closeModalDeleteMenu: Function,
    deleteMenuProcess: Function,
    openSuccessDialog: Boolean,
    successDialog: Object,
    deleteMenuConfirmation: Function,
};

// create props
export const createProps = {
    successDialog: Object,
    openSuccessDialog: Boolean,
    openCreateNewMenuModal: Boolean,
    createNewMenuModal: Function,
    closeModalCreateNewMenu: Function,
    form: Object,
    createMenuProcess: Function,
};

// edit props
export const editProps = {
    isEditMenuModalOpen: Boolean,
    closeEditMenuModal: Function,
    form: Object,
    editMenuProcess: Function,
    openModalEditMenu: Function,
    parentOptions:Array
};
