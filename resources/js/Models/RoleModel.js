// general props
export const generalProps = {
    title: {
        type: String,
        default: "Role",
    },
};

// delete props
export const deleteProps = {
    confirmingRoleDeletion: Boolean,
    closeModalDeleteRole: Function,
    deleteRoleProcess: Function,
    openSuccessDialog: Boolean,
    successDialog: Object,
    deleteRoleConfirmation: Function,
};

// create props
export const createProps = {
    successDialog: Object,
    openSuccessDialog: Boolean,
    openCreateNewRoleModal: Boolean,
    createNewRoleModal: Function,
    closeModalCreateNewRole: Function,
    form: Object,
    createRoleProcess: Function,
};

// edit props
export const editProps = {
    isEditRoleModalOpen: Boolean,
    closeEditRoleModal: Function,
    form: Object,
    editRoleProcess: Function,
    openModalEditRole: Function,
    roleOptions:Array
};
