import {fetch} from '@/services/author';
export const GET_AUTHORS = (state) => {
    fetch().then((res)=>{
        state.authors = res.data
    })
    .catch(error=>{

    });

}
