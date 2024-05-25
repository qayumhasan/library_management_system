import customAxios from '@/services';

export const store = async (data)=>{
    data._method = "POST";
    return await customAxios.post('/borrowd-book',data);
}
export const fetch = async ()=>{
    return await customAxios.get('/borrowd-book');
}

export const update = async (data)=>{
    data._method = "PUT";
    return await customAxios.post(`/borrowd-book/${data.id}`,data);
}

export const remove = async (data)=>{
    data._method = "DELETE";
    return await customAxios.delete(`/borrowd-book/${data.id}`);
}
