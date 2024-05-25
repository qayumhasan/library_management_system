import {fetch} from '@/services/books';
export const GET_BOOKS = (state) => {
    fetch().then((res)=>{
        state.books = res.data
    })
    .catch(error=>{

    });

}
