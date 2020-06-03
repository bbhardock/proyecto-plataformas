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
            swal({
                title: 'Éxito!',
                icon: 'success',
                text: xhr.response.message,
                button: 'Entrar'
            })
            .then(() => {
                console.log("Yei");
                let formData2 = `u=${rut}&p=${password}`;
                let xhr2 = new XMLHttpRequest();
                xhr2.open('post', 'http://losvilos.ucn.cl/tongoy/cp.php?u=19032849k&s=14', true);
                xhr2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr2.responseType = 'json';
                xhr2.addEventListener('load', () => {
                    console.log(xhr2.response);
                    console.log(xhr2.responseText);
                    console.log(xhr2.response.message);
                });
                xhr2.send();
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