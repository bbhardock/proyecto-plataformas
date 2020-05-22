login = () =>{
    event.preventDefault();
    let rut = $("#rut").val();
    let password = $("#password").val();
    let formData = `u=${rut}&p=${password}`;
    let xhr = new XMLHttpRequest();
    xhr.open('post', 'http://losvilos.ucn.cl/tongoy/a.php?op=auth', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.responseType = 'json';
    xhr.addEventListener('load', () => {
        if (xhr.response.status === "ok") {
            console.log(xhr.response)
            console.log(xhr.status)
            console.log(xhr.response.headers)
            swal({
                title: 'Éxito!',
                icon: 'success',
                text: xhr.response.message,
                button: 'Entrar'
            })
            .then(() => {
                console.log("Yei")
                //window.open('login', '_self');
            });
        } else {
            swal({
                title: 'Error',
                icon: 'warning',
                text: xhr.response.message
            });
        }
    });
    xhr.send(formData);
};


$("#login").on('click',login);