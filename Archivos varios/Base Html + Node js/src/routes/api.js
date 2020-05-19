import Express from 'express';
import db from '../middleware/postgresAPI';
import FormValidator from '../middleware/FormValidator'
import multer from 'multer'
import fs from 'fs-extra'

const router = Express.Router();

const requestFormValidation = (preValidation, callback) => {
    return (req, res, next) => {
        if (req.body && req.body.data)
        req.body = JSON.parse(req.body.data);
        const formValidation = preValidation(req.body, req.method);
        if (formValidation.isValid)
        return callback(req, res, next);
        res.status(400).json(formValidation);
    };
};

router.get('/userInfo', (req, res) => {
    res.status(200).json({
      name: req.user.name,
      rut: req.user['user_id'],
      type: req.user['user_type_id']
    });
});


//GET
router.get('/test',db.test);
//POST
router.post('/algo',requestFormValidation(test,exec));
//PUT
router.put('/actualizadoalfgo/:id',test)
//DELETE

router.all('*', (req, res) => {
    res.status(404).json({ message: 'La ruta de la solicitud HTTP no es reconocida por el servidor.' });
});

export default router;
