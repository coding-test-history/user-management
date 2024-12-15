// general props
export const generalProps = {
    title: {
        type: String,
        default: "User List",
    },
};

// delete props
export const deleteProps = {
    confirmingUserDeletion: Boolean,
    closeModalDeleteUser: Function,
    deleteUserProcess: Function,
    openSuccessDialog: Boolean,
    successDialog: Object,
    deleteUserConfirmation: Function,
};

// create props
export const createProps = {
    successDialog: Object,
    openSuccessDialog: Boolean,
    openCreateNewUserModal: Boolean,
    createNewUserModal: Function,
    closeModalCreateNewUser: Function,
    form: Object,
    createUserProcess: Function,
};

// edit props
export const editProps = {
    isEditUserModalOpen: Boolean,
    closeEditUserModal: Function,
    form: Object,
    editUserProcess: Function,
    openModalEditUser: Function,
    roleOptions:Array
};
