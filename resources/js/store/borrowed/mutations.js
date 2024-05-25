import {fetch} from '@/services/borrowd';
export const GET_BORROWD_BOOKS = (state) => {
    fetch().then((res)=>{
        state.borrowedBooks = res.data
    })
    .catch(error=>{

    });

}
