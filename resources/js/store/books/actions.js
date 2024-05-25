import {store,update,remove} from '@/services/books';

export const submit = async ({ commit },book) => {
    return new Promise((resolve,reject)=>{
        store(book).then((res)=>{
            commit('GET_BOOKS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const bookUpdate = async ({ commit },book) => {
    return new Promise((resolve,reject)=>{
        update(book).then((res)=>{
            commit('GET_BOOKS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const removeBook = async ({ commit },book) => {
    return new Promise((resolve,reject)=>{
        remove(book).then((res)=>{
            commit('GET_BOOKS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const getBooks = async ({ commit },author) => {
    commit('GET_BOOKS');
}
