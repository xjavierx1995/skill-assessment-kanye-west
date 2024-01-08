import axios from 'axios';
import { authStore } from '../store/auth.store';
import ToastEventBus from 'primevue/toasteventbus';

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

    ToastEventBus.emit('add', {
      severity: 'error',
      summary: error.response.data.data ? error.response.data.data.error : '',
      detail: error.response.data.message,
      life: 5000
    });
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
