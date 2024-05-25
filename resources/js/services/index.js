import axios from 'axios';

const customAxios = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
  headers: {
    'Content-Type': 'application/json',
     withCredentials: true
  }
});

export default customAxios;