<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    const PUBLICADO = 1;
    const BORRADOR = 2;
    const BORRADO = 3;



    public $timestamps = false;
    protected $table = "productos";

    protected $fillable = [
        'id',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'email',
        'password',
        'tipo',
        'estado_calidad',
        'sexo',
        'direccion',
        'conocido',
        'deuda_total',
    ];

    public function __toString()
    {
        return $this->tipo.' '.$this->categoria.' '.$this->color.' '.$this->talla;
    }


    public function scopeActivas($query)
    {
        return $query->where('borrado',Producto::PUBLICADO);
    }


    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }
    public function color(){
        return $this->belongsTo('App\Models\Color');
    }
    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }
    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor');
    }
    public function talla(){
        return $this->belongsTo('App\Models\Talla');
    }
    public function tipo(){
        return $this->belongsTo('App\Models\Tipo');
    }
    public function genero(){
        return $this->belongsTo('App\Models\Genero');
    }
    public function compras(){
        return $this->belongsToMany('App\Models\Producto');
    }

    public function scopeOfCategoria($query, $categoria)
    {
        if($categoria){
            return $query->where('categoria_id',$categoria);
        }
    }
    public function scopeOfTipo($query, $tipo)
    {
        if($tipo)
            return $query->where('tipo_id',$tipo);
    }
    public function scopeOfMarca($query, $marca)
    {
        if($marca)
            return $query->where('marca_id',$marca);
    }
    public static function ofGenero($genero)
    {
    return static::where('genero_id',$genero);
    }
    public static function ofProveedor($proveedor)
    {
    return static::where('proveedor_id',$proveedor);
    }
    public static function ofColor($color)
    {
    return static::where('color_id',$color);
    }
    public static function ofTalla($talla)
    {
    return static::where('talla_id',$talla);
    }

}
