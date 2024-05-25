import {varify,registerUser,logout} from '@/services/auth';
import { ElNotification } from "element-plus";
export const userVarify = async ({ commit}) => {
        varify().then((res)=>{
            localStorage.setItem('user_info',JSON.stringify(res.data));
            commit('SET_USER',res.data);
        })
        .catch(error=>{
            if(error.response.status ==401){
                localStorage.setItem('user_info','');
                commit('SET_USER','');
                ElNotification({
                    title: "Error",
                    message: 'Unauthorized',
                    type: "errors",
                  });
            }
            // reject(error);
        });
}

export const hasPermission = (name) => {
    let userInfo = localStorage.getItem("user_info");
    let user = JSON.parse(userInfo);
    const permissions = user.permissions.map(permission => permission.name);
    return permissions.includes(name);
};

export const userLogout = () => {

    return new Promise((resolve,reject)=>{
        logout().then((res)=>{
            localStorage.setItem('user_info','');
            resolve(res.data);
        })
        .catch(error=>{
            if(error.response.status ==401){
                ElNotification({
                    title: "Error",
                    message: 'Unauthorized',
                    type: "errors",
                  });
            }
            reject(error);
        });
    })

};

