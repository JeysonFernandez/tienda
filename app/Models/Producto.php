<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{



    public $timestamps = false;
    protected $table = "productos";

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function color(){
        return $this->belongsTo('App\Color');
    }
    public function marca(){
        return $this->belongsTo('App\Marca');
    }
    public function proveedor(){
        return $this->belongsTo('App\Proveedor');
    }
    public function talla(){
        return $this->belongsTo('App\Talla');
    }
    public function tipo(){
        return $this->belongsTo('App\Tipo');
    }
    public function genero(){
        return $this->belongsTo('App\Genero');
    }
    public function compras(){
        return $this->belongsToMany('App\Producto');
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
