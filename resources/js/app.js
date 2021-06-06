require('./bootstrap');

const ujs = require('@rails/ujs');
ujs.start();

$('. form-control-select').select2();
