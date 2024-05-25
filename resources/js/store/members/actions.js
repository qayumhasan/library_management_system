import {store,update,remove} from '@/services/members';

export const submit = async ({ commit },member) => {
    return new Promise((resolve,reject)=>{
        store(member).then((res)=>{
            commit('GET_MEMBERS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const memberUpdate = async ({ commit },member) => {
    return new Promise((resolve,reject)=>{
        update(member).then((res)=>{
            commit('GET_MEMBERS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const removeMember = async ({ commit },book) => {
    return new Promise((resolve,reject)=>{
        remove(book).then((res)=>{
            commit('GET_MEMBERS');
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const getMembers = async ({ commit }) => {
    commit('GET_MEMBERS');
}
