//var XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;
let xhr = new XMLHttpRequest;
const url ='http://losvilos.ucn.cl//tongoy/g.php?&sala=-1&curso=-1&profesor=120&semestre=14&semestrec=-1&carrera=-1&area=-1'
xhr.open('GET',url,true)

xhr.send();    

xhr.onreadystatechange = function(){
    if(this.status === 200){
        const paq=JSON.parse(this.responseText);

        let res = document.querySelector('#res');
        res.innerHTML = '';

        var arrNombres = [];
        for(var i=0;i<paq.length;i++){
            res.innerHTML += `
                <tr>
                <td>${paq[i].id}</td>
                <td>${paq[i].dia}</td>
                <td>${paq[i].bloque}</td>
                <td>${paq[i].sala}</td>
                <td>${paq[i].curso}</td>
                <td>${paq[i].idcurso}</td>
                <td>${paq[i].nrc}</td>
                <td>${paq[i].profesor}</td>
                </tr>
            `
        }
    }
}
