import {registerUser,users,update} from '@/services/auth';
import { ElNotification } from "element-plus";
export const register = async ({ commit},params) => {
    return new Promise((resolve,reject)=>{
        registerUser(params).then((res)=>{
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}


export const getUser = async ({ commit},params) => {
    return new Promise((resolve,reject)=>{
        users().then((res)=>{
            commit('SET_USERS',res.data);
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

export const userUpdate = async ({ commit},params) => {
    return new Promise((resolve,reject)=>{
        update(params).then((res)=>{
            resolve(res.data);
        })
        .catch(error=>{
            reject(error);
        });
    })

}

