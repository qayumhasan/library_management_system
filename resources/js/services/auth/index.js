import customAxios from '@/services';

export const varify = async ()=>{
    return await customAxios.get('/auth/varify');
}
export const registerUser = async (data)=>{
    data._method = "POST";
    return await customAxios.post('/users',data);
}
export const users = async ()=>{
    return await customAxios.get('/users');
}
export const update = async (data)=>{
    data._method = "PUT";
    return await customAxios.post(`/users/${data.id}`,data);
}

export const logout = async ()=>{
    return await customAxios.post(`/logout`);
}


