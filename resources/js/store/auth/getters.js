export const isUserVarify = (state) => {
    console.log(state.auth_user);
    return state.auth_user instanceof Object
}
