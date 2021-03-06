
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');


//seccion de expresiones regulares para validar:
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/

}

//campos validos o no (valor booleano)
const campos = {
    email: false,
    password: false
}

const validarFormulario = (e) =>{
    //console.log(e.target.name);
    switch(e.target.name){
        case "email":
            //prueba de expresión regular
            validarCampo(expresiones.correo, e.target, 'email');
        break;


        case "password":
            //prueba de expresión regular
            validarCampo(expresiones.password, e.target, 'password');
        break;

    }

}


//funcion para validar campo:
const validarCampo = (expresion, input, campo) =>{
    //prueba de expresión regular
    if(expresion.test(input.value)){
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    
    } else { 
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}

inputs.forEach((input) => {
    //se realiza una validación cada que el usuario deja de escribir en un campo
    input.addEventListener('keyup', validarFormulario );
    //se realiza validación cada que de un click fuera del input:
    input.addEventListener('blur', validarFormulario );
})

//e = evento
formulario.addEventListener('submit',(e) => {
    //previene que se envien los datos antes de tiempo:
    e.preventDefault();


    //comprobación de todos los campos:
    if(campos.email && campos.password){

        //rescate de datos válidos para trabajar:

        console.log(e.target.email.value);
        console.log(e.target.password.value);

        //Se envía formulario
        formulario.submit();

        //return true;

        document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
        setTimeout(() =>{
            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
        }, 5000);



    }else{
        //si no todos los campos son verdadero:
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
        return false;
    }
});