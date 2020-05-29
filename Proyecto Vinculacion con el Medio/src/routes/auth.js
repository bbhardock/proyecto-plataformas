import Express from 'express';
import Passport from 'passport';
//import db from '../middleware/postgresAPI';
import connection from '../middleware/postgresConnection';

const router = new Express.Router();

router.post('/login', Passport.authenticate('local'), (req, res) => {
  return res.json({
    success: true,
    message: 'Ha logrado ingresar al sistema con éxito!',
    user: req.user
  });
});


router.get('/checkLogin', (req, res) => {
  res.status(200).json({
    logged: true
  });
});

router.get('/logout', function (req, res) {
  req.logOut();
  res.redirect('/');
});


export default router;