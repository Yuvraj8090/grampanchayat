import './bootstrap'; // Laravel default

// 1. Import jQuery and assign to window
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// 2. Import Bootstrap
import 'bootstrap';

// 3. Import DataTables
import 'datatables.net-bs5';

// Optional: Auto-initialize all datatables on the page if you like
$(function() {
    $('.table').DataTable();
});