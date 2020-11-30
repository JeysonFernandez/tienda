<?php

/**
 * Funciones útiles para el sistema.
 *
 * @author David Vega
 */
if (!function_exists('moneda')) {
    /**
     * Formatea un número en moneda chilena.
     *
     * @param float|int $number   Número
     * @param string    $prefix   Prefijo de moneda ($)
     * @param int       $decimals Cantidad de decimales
     *
     * @return string String de número formateado como moneda
     */
    function moneda($number, $prefix = '$ ', $decimals = 0)
    {
        return $prefix.number_format($number, $decimals, ',', '.');
    }
}

if (!function_exists('dia_semana')) {
    function dia_semana($date)
    {
        $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        return $dias[date('w', strtotime($date))];
    }
}

if (!function_exists('nombre_dia')) {
    function nombre_dia($numero)
    {
        $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        return $dias[$numero];
    }
}

if (!function_exists('fecha')) {
    function fecha($date, $format = 'd-m-Y')
    {
        return !(empty($date)) ? date($format, strtotime($date)) : '';
    }
}

if (!function_exists('hora')) {
    function hora($date, $format = 'H:i')
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('fecha_hora')) {
    function fecha_hora($date, $format = 'd-m-Y H:i')
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('flash')) {
    function flash($name = 'message', $message)
    {
        session()->flash($name, $message);
    }
}

if (!function_exists('etiqueta_estado_cita')) {
    function etiqueta_estado_cita($estado_cita)
    {
        $template = '<span class="badge badge-%s text-%s">%s</span>';
        switch ($estado_cita->id) {
            case 1:
                return sprintf($template, 'warning', 'white', $estado_cita->nombre);

                break;
            case 2:
                return sprintf($template, 'warning', 'white', $estado_cita->nombre);

                break;
            case 3:
                return sprintf($template, 'primary', 'white', $estado_cita->nombre);

                break;
            case 4:
                return sprintf($template, 'primary', 'white', $estado_cita->nombre);

                break;
            case 5:
                return sprintf($template, 'success', 'white', $estado_cita->nombre);

                break;
            case 6:
                return sprintf($template, 'success', 'white', $estado_cita->nombre);

                break;
            case 7:
                return sprintf($template, 'secondary', 'white', $estado_cita->nombre);

                break;
            case 8:
                return sprintf($template, 'warning', 'white', $estado_cita->nombre);

                break;
            default:
                return sprintf($template, 'secondary', 'white', $estado_cita->nombre);
        }
    }
}

if (!function_exists('etiqueta_estado_transaccion')) {
    function etiqueta_estado_transaccion($estado_transaccion)
    {
        $template = '<span class="badge badge-%s text-%s">%s</span>';
        switch ($estado_transaccion->id) {
            case 1:
                return sprintf($template, 'warning', 'white', $estado_transaccion->nombre);

                break;
            case 2:
                return sprintf($template, 'success', 'white', $estado_transaccion->nombre);

                break;
            case 3:
                return sprintf($template, 'secondary', 'white', $estado_transaccion->nombre);

                break;
            case 4:
                return sprintf($template, 'danger', 'white', $estado_transaccion->nombre);

                break;
            case 5:
                return sprintf($template, 'secondary', 'white', $estado_transaccion->nombre);

                break;
            default:
                return sprintf($template, 'secondary', 'white', $estado_transaccion->nombre);
        }
    }
}

if (!function_exists('etiqueta_activo')) {
    function etiqueta_activo($activo)
    {
        $template = '<span class="badge badge-%s text-%s">%s</span>';
        switch ($activo) {
            case 0:
            case false:
                return sprintf($template, 'secondary', 'white', 'Inactivo');

                break;
            case 1:
            case true:
                return sprintf($template, 'success', 'white', 'Activo');

                break;
            default:
                return sprintf($template, 'secondary', 'white', '-');
        }
    }
}

if (!function_exists('etiqueta_validado')) {
    function etiqueta_validado($validado)
    {
        $template = '<span class="badge badge-%s text-%s">%s</span>';
        switch ($validado) {
            case 0:
            case false:
                return sprintf($template, 'danger', 'white', 'No validado');

                break;
            case 1:
            case true:
                return sprintf($template, 'success', 'white', 'Validado');

                break;
            default:
                return sprintf($template, 'secondary', 'white', '-');
        }
    }
}

if (!function_exists('icon_boolean')) {
    function icon_boolean($boolean)
    {
        $template = '<i class="fas fa-fw fa-%s text-%s"></i>';
        switch ($boolean) {
            case 0:
            case false:
                return sprintf($template, 'times', 'danger');

                break;
            case 1:
            case true:
                return sprintf($template, 'check', 'success');

                break;
            default:
                return '';
        }
    }
}

if (!function_exists('icon_file')) {
    function icon_file($extension, $class = '')
    {
        $template = '<i class="fas fa-fw fa-%s '.$class.'"></i>';
        switch ($extension) {
            case 'pdf':
                return sprintf($template, 'file-pdf');

                break;
            case 'doc':
            case 'docx':
                return sprintf($template, 'file-word');

                break;
            case 'xls':
            case 'xlsx':
                return sprintf($template, 'file-excel');

                break;
            case 'zip':
            case '7z':
            case 'tar':
            case 'gz':
            case 'rar':
                return sprintf($template, 'file-archive');

                break;
            default:
                return sprintf($template, 'file');
        }
    }
}

if (!function_exists('estrellas')) {
    function estrellas($numero = 0, $max = 5, $class = '')
    {
        $star_1 = '<i class="fas fa-star '.$class.'"></i>';
        $star_m = '<i class="fas fa-star-half-alt '.$class.'"></i>';
        $star_0 = '<i class="far fa-star '.$class.'"></i>';
        $stars = '';
        for ($i = 0; $i <= $max; ++$i) {
            if ($numero >= ($i + 1)) {
                $stars .= $star_1;
            } elseif ($numero > $i && $numero < ($i + 1)) {
                $stars .= $star_m;
            } elseif ($i < $max) {
                $stars .= $star_0;
            }
        }

        return $stars;
    }
}

if (!function_exists('bytes_to_human')) {
    function bytes_to_human($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; ++$i) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}

if (!function_exists('calcular_edad')) {
    function calcular_edad($fecha_nacimiento)
    {
        try {
            return (int) floor((time() - strtotime($fecha_nacimiento)) / (365 * 24 * 60 * 60));
        } catch (Exception $e) {
            return -1;
        }
    }
}

if (!function_exists('zerofill')) {
    function zerofill($numero, $largo)
    {
        return str_pad($numero, $largo, '0', STR_PAD_LEFT);
    }
}
