import Express from 'express';
import Passport from 'passport';
import User from '../models/user';
import db from '../middleware/postgresAPI';

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


router.get('/register', (req, res) => {
  User.register(
    {user_id: '19.042.481-2', user_type_id: 'ADM', name: 'test'},
    'test',
    (err, user) => 
    {
      console.log(err);
      res.json({user, err})
    }
  );
});



export default router;