window.addEventListener('resize', resize);

function resize() {
    const formImage = document.querySelector('.form__image');
    formImage.style.height = document.body.scrollHeight + 'px';
}

resize();