const fetch = require("node-fetch");

function auth(username,password){
    const url = 'http://losvilos.ucn.cl/tongoy/a.php?op=auth'

    fetch(url, {
    method: 'POST',
    credentials: 'include', 
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
    },
    body: 'u='+username+'&p='+password,
    })
    .then(response => response.json())
    .then(data => {
        if(data.status=='ok'){
            console.log('Todo piola wachin');
        }
        else{
            console.log('No no, la cagaste');
            console.log("Cacha el error: "+ data.mensaje)
        }
    })

}

function get_cursos(username,semestre){
    const url = 'http://losvilos.ucn.cl/tongoy/cp.php'

    fetch(url, {
    method: 'GET',
    credentials: 'include', 
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
    },
    body: 'u='+username+'&s='+semestre,
    })
    .then(response => response.json())
    .then(data => {
        if(data.status=='error'){
            console.log('No no, la cagaste');
            console.log("Cacha el error: "+ data.mensaje)
        }
        else{
            console.log(data);
        }
    })
}
rut='algo';
pass='algo';
semestre='algo'; //ojo que no se como funciona el id de semestre

auth(rut,pass);//este funca
get_cursos(rut,semestre);//este nop