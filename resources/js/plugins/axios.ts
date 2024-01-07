import axios from 'axios';
import { authStore } from '../store/auth.store';
import router from '../router';
const instance = axios.create({
  baseURL: 'http://localhost:8000/api',
});

instance.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if (error.message === 'Network Error') {
      // Manejar error de red aquí
    }

    console.error('Ha ocurrido un error');

    return Promise.reject(error);
  }
);

// Request interceptor for API calls
instance.interceptors.request.use(
  async config => {
    const auth = authStore();
    if(config.url !== '/login' && config.url !== '/register') {
      config.headers = {
        'Authorization': `Bearer ${auth.access_token}`,
        'Accept': 'application/json',
        // 'Content-Type': 'application/x-www-form-urlencoded'
      }
    }
    return config;
  },
  error => {
    Promise.reject(error)
});

export default instance
