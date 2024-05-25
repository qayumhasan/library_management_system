import {store,update,remove} from '@/services/author';
export const submit = async ({ commit },author) => {
    return new Promise((resolve,reject)=>{
        store(author).then((res)=>{
            commit('GET_AUTHORS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const authorUpdate = async ({ commit },author) => {
    return new Promise((resolve,reject)=>{
        update(author).then((res)=>{
            commit('GET_AUTHORS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const removeAuthor = async ({ commit },author) => {
    return new Promise((resolve,reject)=>{
        remove(author).then((res)=>{
            commit('GET_AUTHORS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const getAuthors = async ({ commit },author) => {
    commit('GET_AUTHORS');
}
