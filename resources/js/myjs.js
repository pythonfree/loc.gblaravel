let button = document.querySelector('.parseAction');
if (button) {
    button.addEventListener('click', () => {
        let success = document.querySelector('.alert-success');
        let danger = document.querySelector('.alert-danger');
        let warning = document.querySelector('.alert-warning');
        axios.get('/api/parseAction')
            .then(response => {
                const answer = response.data;
                if (answer.status === 'ok') {
                    success.classList.toggle("d-none");
                    setTimeout(() => {
                        success.classList.toggle("d-none");
                    }, "3000");
                } else if (answer.status === 'false') {
                    danger.classList.toggle("d-none");
                    setTimeout(() => {
                        danger.classList.toggle("d-none");
                    }, "3000");
                } else {
                    warning.insertAdjacentHTML('afterbegin', response.data);
                    warning.classList.toggle("d-none");
                    setTimeout(() => {
                        warning.classList.toggle("d-none");
                    }, "3000");
                }
            })
            .catch(error => {
                warning.innerHTML = '';
                warning.insertAdjacentHTML(
                    'afterbegin',
                    'Результат не известен. Работает ли <a class="errorMessage" href="/horizon">Horizon</a>?<br>' + error.message
                );
                warning.classList.toggle("d-none");
                setTimeout(() => {
                    warning.classList.toggle("d-none");
                }, "3000");
            })
        ;
    });
}

