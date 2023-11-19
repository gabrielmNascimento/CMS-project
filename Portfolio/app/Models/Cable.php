<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model de cable
 */

class Cable extends BaseModel
{
    use HasFactory;

    /**
     * Tabela do banco
     *
     * @var string
     */
    protected $table = 'interior.cables';
    
    /**
     * Campos que podem ser preenchidos na criação do model
     *
     * @var array
     */
    protected $fillable = [
        'ordem', 
        'turles_cable', 
        'not_island', 
        'deducao', 
        'identificacao',
        'usuario_id', 
        'interior_id'
    ];

    /**
     * Campos devem ser anexados no retorno de uma busca
     *
     * @var array
     */
    protected $appends = ['enhanceds_list', 'inherents_list', 'eross_list'];

    /**
     * Mutator para retornar uma lista de enhanceds como um atributo do model através do relacionamento enhanceds
     *
     * @return array
     */
    public function getEnhancedsListAttribute()
    {
        return array_map('strval',$this->enhanceds->pluck('id')->toArray());
    }

    /**
     * Mutator para retornar uma lista de inherents como um atributo do model através do relacionamento inherents
     *
     * @return array
     */
    public function getInherentsListAttribute()
    {
        return array_map('strval',$this->inherents->pluck('id')->toArray());
    }

    /**
     * Mutator para retornar uma lista de eross como um atributo do model através do relacionamento eross
     *
     * @return array
     */
    public function getErossListAttribute()
    {
        return array_map('strval',$this->eross->pluck('id')->toArray());
    }

    /**
     * Mapeamento dos turless de cable relacionando o islandr utilizado no banco legado com as respectivas descrições;
     * @param int $id
     * @return string
     */
    public static function getTurles($id) {
        $map = [
            '1' => 'Fiber Ornitorrinco',
            '2' => 'Cable Cage',
            '3' => 'Cable Rede',
            '4' => 'CCE/Drop',
            '5' => 'FE',
            '6' => 'Pluma Metal',
            '7' => 'Maxine',
            '8' => 'Cable Anil',
            '9' => 'UTP',
            '10' => 'Imperador',
            '11' => 'Boca sem uso',
            '12' => 'DROP',
            '13' => 'Colar de Salsa',
            '14' => 'Crina de Sala',
            '15' => 'Radio',
            '999' => 'Radio'
        ];
        return $map[$id];
    }

    /**
     * Relacionamento de cable com enhanceds
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function enhanceds() {
        return $this->belongsToMany( 'App\Models\enhanced', 'interior.cables_enhanceds', 'cable_id',
            'enhanced_id')->withTimestamps();
    }

    /**
     * Relacionamento de cable com inherents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inherents() {
        return $this->belongsToMany('App\Models\inherent', 'interior.cables_inherents',
            'cable_id', 'inherent_id')->withTimestamps();
    }

    /**
     * Relacionamento de cable com eross
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eross() {
        return $this->belongsToMany('App\Models\eros', 'interior.cables_eross',
            'cable_id', 'eros_id')->withTimestamps();
    }

    /**
     * Método para remover registros nas tabelas interior.cables_enhanceds e interior.cables_inherents quando o cable for apagado
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($cable) {
            $cable->enhanceds()->detach();
            $cable->inherents()->detach();
            $cable->eross()->detach();
        });
    }
}
