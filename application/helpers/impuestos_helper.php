<?php 

function para_resivir_paypal($monto = null) {
    if( $monto AND !is_nan($monto) ) {
        return (100 * (0.3 + $monto)) / ((0 - 5.4) + 100);
    } 
}

function si_envio_paypal($monto = null)
{
	if( $monto AND !is_nan($monto) ) {
		return $monto - (((5.4 * $monto) / 100) + 0.3) ;
		
	} 
	
}
