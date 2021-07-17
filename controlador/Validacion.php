<?php
    class Validacion {
        #Validación de campos de texto para Nombres propios s/n.
        public function nombresPropios($entrada, $min, $max) {
            $stringRegExp = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{".$min.",".$max."}$/";
            return preg_match($stringRegExp, $entrada);
        }
        
        #Validación de campos de texto para Nombres propios numerados.
        public function nombresPropiosNumerados($entrada, $min, $max) {
            $stringRegExp = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{".$min.",".$max."}$/";
            return preg_match($stringRegExp, $entrada);
        }
        
        #Validación de campos de texto para descripciones y referencias.
        public function descripciones($entrada, $min, $max) {
            $stringRegExp = "/^[0-9a-zA-Z0-9áéíóúÁÉÍÓÚñÑ.,-_\/\&# ]{".$min.",".$max."}$/";
            return preg_match($stringRegExp, $entrada);
        }
        
        #Validación de campos de texto para nombres de usuario.
        public function nombresUsuarios($entrada, $min, $max) {
            $stringRegExp = "/^[0-9a-zA-Z ]{".$min.",".$max."}$/";
            return preg_match($stringRegExp, $entrada);
        }
        
        #Validación de campos de texto para contraseñas.
        public function contrasenas($entrada, $max) {
            $stringRegExp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{4,}$/";
            return preg_match($stringRegExp, $entrada) && strlen($entrada) <= $max;
        }
        
        #Validación de campos de texto para correos electrónicos.
        public function correosElectronicos($entrada, $max) {
            $stringRegExp = "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
            return preg_match($stringRegExp, $entrada) && strlen($entrada) <= $max;
        }
        
        #Validación de campos de numéricos para enteros con longitud variable.
        public function enterosEnIntervalo($entrada, $min, $max) {
            $stringRegExp = "/^[0-9]{".$min.",".$max."}$/";
            return preg_match($stringRegExp, $entrada);
        }
        
        #Validación de campos de numéricos para enteros con longitud constante.
        public function enterosSinIntervalo($entrada, $max) {
            $stringRegExp = "/^[0-9]{".$max."}$/";
            return preg_match($stringRegExp, $entrada);
        }
        
        #Validación de campos de numéricos para decimales con 3 cifras después del punto.
        public function decimales($entrada, $max) {
            $stringRegExp = "/^[0-9]+([.][0-9]+)?$/";
            return preg_match($stringRegExp, $entrada) && strlen($entrada) <= $max;
        }
    }