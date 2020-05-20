
function auth(username,password){
    const url = 'https://losvilos.ucn.cl/tongoy/a.php?op=auth'
    
    fetch(url, {
    method: 'POST',
    body: 'u='+username+'&p='+password
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
    let queryString = '?u='+username+'&s='+semestre;

    const urlQuery=url+queryString;

    fetch(urlQuery,{
        method:'GET',
        credentials:'include'
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
var formulario = document.getElementById("Ingresar");
formulario.addEventListener("submit", function(e){   
    
    var datos = new FormData(formulario);

    var user = datos.get('user');
    var pass = datos.get('pass');

    auth(user,pass);
    e.preventDefault();
});
