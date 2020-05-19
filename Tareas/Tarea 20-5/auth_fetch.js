
function auth(username,password){
    const url = 'https://losvilos.ucn.cl/tongoy/a.php?op=auth'
    
    fetch(url, {
    method: 'POST',
    credentials: 'include', 
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json',
        'Access-Control-Allow-Origin': 'file:///C:/Users/nicol/Documents/GitHub/proyecto-plataformas/Tareas/Tarea%2020-5/login.html'
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
document.getElementById("Ingresar").addEventListener("submit", function(e){
    const user = document.getElementById("usuario");
    const pass = document.getElementById("password");

    auth(user,pass);

    e.preventDefault();
});