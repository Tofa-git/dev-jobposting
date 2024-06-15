import * as bootstrap from 'bootstrap/dist/js/bootstrap';
window.bootstrap = bootstrap;

import '@popperjs/core';

import jQuery from 'jquery';
window.$ = jQuery;

import toastr from 'toastr';
window.toastr = toastr;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import * as globalFunction from '../../public/assets/js/login.js';
window.globalFunction = globalFunction;