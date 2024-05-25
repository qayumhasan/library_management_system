import {fetch} from '@/services/members';
export const GET_MEMBERS = (state) => {
    fetch().then((res)=>{
        state.members = res.data
    })
    .catch(error=>{

    });

}
