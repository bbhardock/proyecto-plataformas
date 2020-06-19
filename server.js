const express = require('express')
const app = express()
const path = require('path')
const pool = require("./dbConfig")
const session = require('express-session')
const flash = require('express-flash')
const bcrypt = require('bcrypt')
const passport = require ('passport')
const initializePassport = require ("./passportConfig")
initializePassport(passport)

//configuracion de post
app.use(express.urlencoded({extended:false}))

//configuración de vistas (en este caso, nuestro frontend)
app.set('view engine', 'ejs'); //motor ejs para las vistas
app.set('views', path.join(__dirname, 'views')); 


//direccionamiento para statics (css y cosas asi)
app.use(express.static(path.join(__dirname, 'src/static')));
app.use(express.static('src/static/css'))
app.use(express.static('src/static/images'));

//para sessions
app.use(session({
    secret: 'secret',
    resave: false,
    saveUninitialized: false
}))

//para mostrar cosas con flash (no sé si lo usaremos depende del nico jaja)
//app.use(flash())

//para usar la autenticacion de passport
app.use(passport.initialize())
app.use(passport.session())

app.get('/', (req, res) =>{
    res.render('index')
})

app.get('/registro', (req,res) =>{
    res.render('registro')
})
//sería bueno tener validación de formulario abajo (especialmente para el rut)
app.post('/registro',(req,res) =>{
    let {rut,nombre,telefono,email} = req.body
    //ahora revisamos si existe jejeee
    pool.query(
        `SELECT * from usuarios
        WHERE UPPER(rut) = UPPER($1)`,[rut],(err,results)=>{
            if(err){
                throw err
            }
            if(results.rows.length > 0){
                console.log("Usuario ya existe")
                res.render('registro')
            }else{
                pool.query(
                    `INSERT INTO usuarios(rut,nombre,telefono,correo_electronico,estado,es_admin)
                    VALUES($1,$2,$3,$4,$5,$6)
                    RETURNING id_code`,
                    [rut,nombre,telefono,email,'P','N'],
                    (err,results) => {
                        if(err){
                            throw err
                        }
                        console.log(results.rows);
                        //req.flash('sucess_msg',"Registrado")
                        res.redirect('login')
                    }
                )
            }
        }
    )
})

app.get('/login', (req,res)=>{
    res.render('login')
})

app.post('/login', passport.authenticate('local', {
    successRedirect: '/dashboard',
    failureRedirect: '/login'
    //,failureFlash: true
})
)

app.get('/dashboard', (req, res) =>{
    res.render('dashboard')
})


app.listen(3000)