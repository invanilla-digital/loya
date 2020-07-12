(function () {
    const burger: HTMLElement | null = document.querySelector('.burger');

    if (!burger) {
        return;
    }

    const menu: HTMLElement | null = document.querySelector('#' + burger.dataset.target);

    if (!menu) {
        return;
    }

    burger.addEventListener('click', () => {
        burger.classList.toggle('is-active');
        menu.classList.toggle('is-active');
    });
})();