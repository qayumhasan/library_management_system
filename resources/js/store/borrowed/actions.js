import {store,update,remove} from '@/services/borrowd';
export const submit = async ({ commit },borrowd) => {
    return new Promise((resolve,reject)=>{
        store(borrowd).then((res)=>{
            commit('GET_BORROWD_BOOKS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}



export const getBorrowedBooks = async ({ commit },author) => {
    commit('GET_BORROWD_BOOKS');
}

export const removeBorrowedBook = async ({ commit },borrowed) => {
    return new Promise((resolve,reject)=>{
        remove(borrowed).then((res)=>{
            commit('GET_BORROWD_BOOKS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const borrowedBookUpdate = async ({ commit },borrowed) => {
    return new Promise((resolve,reject)=>{
        update(borrowed).then((res)=>{
            commit('GET_BORROWD_BOOKS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

