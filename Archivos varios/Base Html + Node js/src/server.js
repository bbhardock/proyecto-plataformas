import express from 'express';
import path from 'path';
import config from './config.json';
import apiRoutes from './routes/api';
import Pg from 'pg';
import BodyParser from 'body-parser';
import MethodOverride from 'method-override';
import ConnectPg from 'connect-pg-simple';
import Passport from 'passport';
import Session from 'express-session';
import CookieParser from 'cookie-parser';
import authRoutes from './routes/auth';
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

app.get('/',(req,res)=>{
    res.render('test');
})

const isAuthenticated = (req, res, next) => {
    if (req.isAuthenticated()) {
      return next();
    }
    res.status(401).json({
      error: 'Unauthorized access',
      message: 'User must be logged to access the specified URI'
    });
};

app.use(`/auth`, authRoutes);
//app.use(`/api`, isAuthenticated , apiRoutes); 
app.use(`/api`, apiRoutes); 

let port = 3000;

if (process.env.NODE_PORT) port = process.env.NODE_PORT;

app.listen(port, () => {
    console.log(`El servidor está escuchando en el puerto ${port}`);
}); // escuchar el puerto