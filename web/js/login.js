window.addEventListener('resize', resize);

function resize() {
    const formImage = document.querySelector('.form_image_login_cp');
    formImage.style.height = document.body.scrollHeight + 'px';
}
window.addEventListener('DOMContentLoaded', function(){
    resize();
})
