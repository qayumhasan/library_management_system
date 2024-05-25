import {fetch} from '@/services/author';
export const SET_USER = (state,user) => {
    state.auth_user =user
}
