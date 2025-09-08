<?php
namespace App\Models;

class Calculator {
    // Interés compuesto: A = P * (1 + r)^n
    public static function compoundInterest($principal, $ratePercent, $periods){
        $r = $ratePercent / 100;
        return $principal * pow(1 + $r, $periods);
    }

    // Conversión de velocidad (m/s a km/h)
    public static function msToKmh($ms) {
        return $ms * 3.6;
    }

    // Salario neto en Colombia aproximado: aplicar deducciones (EPS 4%, Pensión 4%, Riesgos variable omitido)
    // Este es un ejemplo simplificado:
    public static function salarioNetoColombia($salarioBruto) {
        $pension = $salarioBruto * 0.04;
        $eps = $salarioBruto * 0.04;
        // Para simplificar no aplicamos aportes parafiscales ni retención en la fuente compleja.
        $deducciones = $pension + $eps;
        return $salarioBruto - $deducciones;
    }
}
