import {fetch} from '@/services/author';
export const SET_PERMISSIONS = (state,permissions) => {
    state.permissions =permissions
}
export const SET_ROLES = (state,roles) => {
    state.roles =roles
}


