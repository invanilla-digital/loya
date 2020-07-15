(function () {
    const buttons: NodeListOf<HTMLElement> = document.querySelectorAll('[data-post-button]');

    Array.from(buttons).forEach((button: HTMLElement) => {
        button.addEventListener('click', function () {
            const api: string | undefined = button.dataset.postButton;
            const confirmation: string | undefined = button.dataset.postButtonConfirmation;

            if (!api) {
                return;
            }

            if (confirmation && !confirm(confirmation)) {
                return;
            }

            fetch(api, {
                method: "DELETE",
                credentials: "include",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;

                    return;
                }

                const json = response.json().then(function (json) {
                    window.location.href = json.redirect_to;
                });
            })
        })
    })
})();