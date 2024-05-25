import axios from '@/services';
import { ElNotification } from "element-plus";
import router from '@/router/index.js';

axios.interceptors.response.use(
    (response) => {
      return response;
    },
    (error) => {
        if(error.response.status == 401){
            localStorage.setItem('user_info','');
            router.push({name:"login"})
        }
        if(error.response.status == 403){
            ElNotification({
                title: "Error",
                message: error.response.data.message,
                type: "error",
              });
              router.push({name:"unauthorized"})
        }
      return Promise.reject(error);
    }
  );
