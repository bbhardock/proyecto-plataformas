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
//import authRoutes from './routes/auth';
import user from './models/user';

const app = express();

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));


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


app.use(Passport.initialize());
app.use(Passport.session());

Passport.use(user.createStrategy());
Passport.serializeUser(user.serializeUser());
Passport.deserializeUser(user.deserializeUser());

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
app.get('/list',(req,res)=>{
    res.render('tabla');
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

//app.use(`/auth`, authRoutes);
//app.use(`/api`, isAuthenticated , apiRoutes); 

let port = 3000;

if (process.env.NODE_PORT) port = process.env.NODE_PORT;

app.listen(port, () => {
    console.log(`El servidor está escuchando en el puerto ${port}`);
}); // escuchar el puerto