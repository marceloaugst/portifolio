import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// O token CSRF é lido automaticamente pelo axios do cookie XSRF-TOKEN
// (renovado pela StartSession a cada resposta), em vez de um valor fixo
// pego no carregamento da página — isso evita 419 depois de login/logout
// via navegação SPA do Inertia, que não recarrega o HTML inicial.
window.axios.defaults.withCredentials = true;
