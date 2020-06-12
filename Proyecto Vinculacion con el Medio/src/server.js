import express from 'express';
import path from 'path';
import config from './config.json';
//import apiRoutes from './routes/api';
import MethodOverride from 'method-override';
import CookieParser from 'cookie-parser';
import Pg from 'pg';
import BodyParser from 'body-parser';
import ConnectPg from 'connect-pg-simple';
import Passport from 'passport';
import Session from 'express-session';
import authRoutes from './routes/auth';
import user from './models/user';
//import cors from "cors";

const app = express();
var passport = require('passport'),
    LocalStrategy = require('passport-local').Strategy;
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.use(express.static('/static/css'))
app.use(express.static('/static/images'));
app.use(express.static(path.join(__dirname, 'static')));
app.use(MethodOverride());
app.use(BodyParser.urlencoded({ extended: false }));
const pgSession = ConnectPg(Session);
app.use(CookieParser());
app.use(Session({
  store: new pgSession({
    pg: Pg,
    conString: config.dbUri,
    tableName: 'session',
    schemaName: 'public',
  }),
  secret: config.secret,
  resave: false,
  saveUninitialized: false,
  cookie: {httpOnly: true, secure: false}
}));


app.use(passport.initialize());
app.use(passport.session());

passport.use(new LocalStrategy({
  usernameField: 'username',
  passwordField: 'password'
},
  (username, password, done) => {
    console.log("Login process:", username);
    return connection.one("SELECT rutusuario" +
      "FROM usuario " +
      "WHERE rutusuario=$1", [username])
      .then((result) => {
        return done(null, username);
      })
      .catch((err) => {
        console.log("/login: " + err);
        return done(null, false, { message: 'Usuario no registrado en plataforma' });
      });
  }));

passport.serializeUser(user.serializeUser());
passport.deserializeUser(user.deserializeUser());

const isAuthenticated = (req, res, next) => {
  if (req.isAuthenticated()) {
    return next();
  }else{
    res.redirect('/');
  }
};


app.get('/',(req,res)=>{
    res.render('login');
})
app.get('/register',(req,res)=>{
    res.render('register');
})
app.get('/editCategoria/:id',isAuthenticated,(req,res)=>{
    res.render('FormCategoria',{id:req.params.id});
})

app.get('/compras',isAuthenticated,(req,res)=>{
  res.render('ventas');
})
app.get('/ayudantia',isAuthenticated,(req,res)=>{
  res.render('ayudantia');
})


app.use(`/auth`, authRoutes);
//app.use(`/api`, isAuthenticated , apiRoutes); 

let port = 3000;

if (process.env.NODE_PORT) port = process.env.NODE_PORT;

app.listen(port, () => {
    console.log(`El servidor está escuchando en el puerto ${port}`);
}); // escuchar el puerto