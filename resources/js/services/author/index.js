import customAxios from '@/services';

export const store = async (author)=>{
    author._method = "POST";
    return await customAxios.post('/authors',author);
}
export const fetch = async (author)=>{
    return await customAxios.get('/authors');
}

export const update = async (author)=>{
    author._method = "PUT";
    return await customAxios.post(`/authors/${author.author_id}`,author);
}

export const remove = async (author)=>{
    author._method = "DELETE";
    return await customAxios.delete(`/authors/${author.id}`);
}
