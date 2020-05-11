var XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;
let xhr = new XMLHttpRequest;
const url ='http://losvilos.ucn.cl//tongoy/g.php?&sala=-1&curso=-1&profesor=120&semestre=14&semestrec=-1&carrera=-1&area=-1'
xhr.open('GET',url,true)


xhr.onload = function(){
    if(this.status === 200){
        const paq=JSON.parse(this.responseText);

        var arrNombres = []
        for(var i=0;i<paq.length;i++){
            if(arrNombres.indexOf(paq[i].curso) == -1){
                arrNombres.push(paq[i].curso);
            }
        }
        console.log(arrNombres.length)
        for(var i = 0; i<arrNombres.length;i++){
            console.log(arrNombres[i]);
        }
        
        

    }
}
xhr.send();
