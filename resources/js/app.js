import './bootstrap'; // Laravel default

// 1. Import jQuery and make it global
import $ from 'jquery';
window.jQuery = window.$ = $;

// 2. Import Bootstrap and MAKE IT GLOBAL (This is the missing step)
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// 3. Import DataTables
import 'datatables.net-bs5';