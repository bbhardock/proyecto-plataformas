import connection from './postgresConnection';
import User from '../models/user';

const functionQueries = {};


functionQueries.test = (req, res, next) => {
    let id = req.params.id
    connection.tx(t=>{
        return t.any("SELECT * FROM size")
    })
    .then(data=>{
        res.status(200).json({data: data, msg: "Se encontraron tamaños"})
    })
    .catch(err=>{
        res.status(500).json({err, msg: "Ha ocurrido un error"})
    })
};

export default functionQueries;
