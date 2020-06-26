const LocalStrategy = require('passport-local').Strategy
const pool = require ('./dbConfig')
const bcrypt = require("bcrypt")
const request = require('request')

function initialize(passport){
    const authenticateUser = (rut,password,done) => {
        pool.query(
            `SELECT * FROM usuarios WHERE rut = $1`,[rut],(err,results) => {
                if(err){
                    throw err;
                }

                if(results.rows.length > 0){
                    const user = results.rows[0]
                    //LOGUEA CON TONGOY
                    if(user.tipo_contrato =='C'){
                        const options = {
                            url:'http://losvilos.ucn.cl/tongoy/a.php?op=auth',
                            form:{
                                u: rut,
                                p: password
                            }
                        };
                        request.post(options, (err,res,body)=> {
                            if (err){
                                return console.log(err)
                            }
                            //console.log(JSON.parse(body))
                            const loginStatus =JSON.parse(body).status
                            if(loginStatus=='ok'){
                                if(user.estado=='A'){
                                    return done(null, user)                                    
                                }else if(user.estado=='P'){
                                    return done(null,false,{message: "El usuario está pendiente de aprobación por la administración, por favor verificar"})
                                }else{
                                    return done(null,false,{messsage: "Se le ha denegado el acceso al usuario por la administración"})
                                }
                            }
                            else{
                                return done(null,false,{message: "Contraseña incorrecta"})
                            }
                        });
                    }
                    //LOGUEA CON CONTRASEÑA INTERNA
                    else if(user.tipo_contrato =='H'){
                        bcrypt.compare(password, user.pass, (err,isMatch) => {
                            if(err){
                                throw err;
                            }
                            if(isMatch){
                                if(user.estado == 'A'){
                                    return done(null,user);                                    
                                }else if(user.estado == 'P'){
                                    return done(null,false,{message: "El usuario está pendiente de aprobación por la administración, por favor verificar"})
                                }else{
                                    return done(null,false,{messsage: "Se le ha denegado el acceso al usuario por la administración"})
                                }
                            }else{
                                return done(null,false,{message: "Contraseña incorrecta"})
                            }
                        })
                    }
                }else{
                    return done(null,false,{message: "RUT indicado no está registrado"})
                }
            }
        );
    };

    passport.use(new LocalStrategy({
        usernameField: "rut",
        passwordField: "password"
    },
    authenticateUser
    ));

    passport.serializeUser((user, done) => done(null,user.id_code))

    passport.deserializeUser((id_code,done) => {
        pool.query(
            `SELECT * FROM usuarios WHERE id_code = $1`,[id_code], (err,results) => {
                if(err){
                    throw err
                }
                return done(null, results.rows[0])
            }
        );
    });
}
module.exports = initialize
