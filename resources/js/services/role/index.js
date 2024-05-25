import customAxios from '@/services';

export const permissions = async ()=>{
    return await customAxios.get('/permissions');
}

export const store = async (data)=>{
    data._method = "POST";
    return await customAxios.post('/roles',data);
}

export const roles = async ()=>{
    return await customAxios.get('/roles');
}
export const remove = async (data)=>{
    return await customAxios.delete(`/roles/${data.id}`);
}

export const updateRole = async (data)=>{
    data._method = "PUT";
    return await customAxios.post(`/roles/${data.id}`,data);
}



