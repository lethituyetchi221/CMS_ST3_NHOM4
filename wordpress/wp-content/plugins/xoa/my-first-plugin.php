<?php
/**
* Plugin Name: xoa-plugin
* Plugin URI: https://www.your-site.com/
* Description: Test.
* Version: 0.1
* Author: your-name
* Author URI: https://www.your-site.com/
**/  
add_action('wp_footer', 'elementhow_add_admin_bar_button');

function elementhow_add_admin_bar_button() {
if (current_user_can('administrator')) {
?>
<div id='toggle-admin-bar-wrapper' style="position:fixed; left:20px; bottom:20px;">
<button id="toggle-admin-bar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M0 0h48v48H0z"/><path d="M14 48h4v-4h-4v4zm8 0h4v-4h-4v4zm4-44h-4v20h4V4zm7 5-3 3a12 12 0 1 1-12 0l-3-3a16 16 0 1 0 18 0zm-3 39h4v-4h-4v4z"/></svg></button>
<button id="toggle-admin-bar-position"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M22 9a1 1 0 0 0 0 1.4l4.6 4.6H3.1a1 1 0 1 0 0 2h23.5L22 21.6a1 1 0 0 0 0 1.4 1 1 0 0 0 1.4 0l6.4-6.4a.9.9 0 0 0 0-1.2L23.4 9A1 1 0 0 0 22 9Z"/></svg></button>
<button id="remove-toggle-admin-bar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 1024"><path d="M640 320 512 192 320 384 128 192 0 320l192 192L0 704l128 128 192-192 192 192 128-128-192-192 192-192z"/></svg></button>
<style>
#toggle-admin-bar-wrapper {
opacity: 0.6;
}

#remove-toggle-admin-bar {
padding: 0;
border: none;
background-color: transparent;
cursor: pointer;
position: absolute;
left: -2px;
top: -11px;
cursor: pointer;
}

#remove-toggle-admin-bar svg {
width: 12px;
height: 12px;
}

.is-lower-left #remove-toggle-admin-bar {
left: 14px;
}

#toggle-admin-bar {
padding: 0;
border: none;
background-color: transparent;
cursor: pointer;
}

#toggle-admin-bar svg {
border-radius: 40px;
width: 26px;
height: 26px;
fill: #000;
stroke: #FFF;
}

#toggle-admin-bar-position {
background-color: transparent;
position: absolute;
border: none;
left: -2px;
bottom: -16px;
cursor: pointer;
padding: 1px 6px;
}

#toggle-admin-bar-position svg {
width: 18px;
height: 18px;
}

.is-lower-left #toggle-admin-bar-position svg {
transform: rotate(180deg);
}
</style>
</div>
<script>
(function () {
let adminBar = document.getElementById('wpadminbar');
let toggleAdminWrapper = document.getElementById('toggle-admin-bar-wrapper');
let toggleAdminBar = document.getElementById('toggle-admin-bar');
let toggleAdminPosition = document.getElementById('toggle-admin-bar-position');
let removeAdminBarToggle = document.getElementById('remove-toggle-admin-bar');
if (!adminBar) {
toggleAdminWrapper.remove();
return;
}
toggleAdminBar.addEventListener('click', function () {
if (adminBar.style.display === 'none') {
adminBar.style.display = 'block';
document.body.classList.add('admin-bar');
document.body.style.removeProperty('margin-top');
document.querySelectorAll('.elementor-sticky--active').forEach(e => e.style.transform = 'translateY(0)')
} else {
adminBar.style.display = 'none';
document.body.classList.remove('admin-bar');
window.innerWidth > 782 ? document.body.style.marginTop = '-32px' : document.body.style.marginTop = '-46px';
window.innerWidth > 782 ? document.querySelectorAll('.elementor-sticky--active').forEach(e => e.style.transform = 'translateY(-32px)') : null;
}
});
toggleAdminPosition.addEventListener('click', function () {
if (toggleAdminWrapper.style.left === '20px') {
toggleAdminWrapper.style.left = 'auto';
toggleAdminWrapper.style.right = '20px';
toggleAdminWrapper.classList.add('is-lower-left');
} else {
toggleAdminWrapper.style.left = '20px';
toggleAdminWrapper.style.right = 'auto';
toggleAdminWrapper.classList.remove('is-lower-left');
}
});
removeAdminBarToggle.addEventListener('click', function () {
toggleAdminWrapper.remove();
});
}());
</script>
<?php
}
}

