import {permissions,store,roles,remove,updateRole} from '@/services/role';
export const getPermission = async ({ commit }) => {
    return new Promise((resolve,reject)=>{
        permissions().then((res)=>{
            commit('SET_PERMISSIONS',res.data);
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const getRoles = async ({ commit }) => {
    return new Promise((resolve,reject)=>{
        roles().then((res)=>{
            commit('SET_ROLES',res.data);
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const submit = async ({ commit },params) => {
    return new Promise((resolve,reject)=>{
        store(params).then((res)=>{
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const update = async ({ commit },params) => {
    return new Promise((resolve,reject)=>{
        updateRole(params).then((res)=>{
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

export const removeRole = async ({ commit },params) => {
    return new Promise((resolve,reject)=>{
        remove(params).then((res)=>{
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })
}

