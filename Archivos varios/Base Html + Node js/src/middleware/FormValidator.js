import empty from 'is-empty';
import Rut from 'rutjs';
import validator from 'validator';
import moment from 'moment';

const validationFunctions = {};

export const validar = validationFunctions.test= (payload) =>{
    let errors = {};
    let isValid = true;
    let message = '';
    if(payload){
        if(empty(payload.nomre)){
            isValid = false;
        }
    }else{
        message= "Error al recibir los datos del formulario";
        isValid = false;
    }
    return {isValid,errors,message};
}


export default validationFunctions;