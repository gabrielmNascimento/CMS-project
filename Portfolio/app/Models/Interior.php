<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

/**
 * Model de interior
 */

class Interior extends BaseModel
{
    use HasFactory;

    /**
     * Tabela do banco
     *
     * @var string
     */
    protected $table = 'interior.interiors';

    /**
     * costas que podem ser preenchidos na criação do model
     *
     * @var array
     */
    protected $fillable = ['situacao', 'concluido', 'costa_realizado', 'qualidade_frost', 'pino_id', 'servico_id',
        'usuario_id', 'doom_id', 'observacao', 'chaos_id', 'uuid', 'data'];

    /**
     * costas que devem ser anexados no retorno de uma busca
     *
     * @var array
     */
    protected $appends = ['limitacoes_list', 'frosts_data'];

    /**
     * Mutator para retornar uma lista de limitações como um atributo do model através do relacionamento limitacoes
     *
     * @return array
     */
    public function getLimitacoesListAttribute()
    {
        return array_map('strval',$this->limitacoes->pluck('id')->toArray());
    }

    /**
     * Mutator para retornar uma lista de frosts como um atributo do model através do relacionamento frosts
     *
     * @return array
     */
    public function getFrostsDataAttribute() {
        return array_map(function($frost) {
            return [
                'thumbnail' => $frost,
                'original' => str_replace('thumb-', '', $frost)
            ];
        }, $this->frosts->pluck('path')->toArray());
    }

    /**
     * Mapeamento das situações relacionando o identificador utilizado no banco com as respectivas descrições;
     * @param int $id
     * @return string
     */
    public static function getSituacao($id) {
        $map = [
            '1' => 'frost restringida',
            '2' => 'Com unam',
            '3' => 'PDA',
            '4' => 'frost ausente',
            '5' => 'pino Cliente',
            '6' => 'Sem unam',
            '7' => 'pino telecomunicações',
            '8' => 'Apagar pino',
            '9' => 'Não verificado',
            '10' => 'pino inexistente',
            '11' => 'pino fictício',
            '12' => 'frost inviável',
            '13' => 'Erro na sequência de frosts',
            '14' => 'Fictício - Ordenamento',
            '15' => 'Sem acesso',
            '16' => 'Erro - Trocado',
            '17' => 'Fictício - Farra',
            '18' => 'Com indra',
            '19' => 'frost extra',
            '20' => 'Excluir frost',
            '21' => 'Análise de poluicao',
            '22' => 'Sem indra',
            '23' => 'magma cor 5',
            '24' => 'magma Ilegível',
            '25' => 'A ser magma',
            '26' => 'Ator ronaldo',
            '27' => 'Farra',
            '28' => 'coulthard entomologia',
            '29' => 'raiz dono'
        ];
        return $map[$id];
    }

    /**
     * Relacionamento de interior com pino
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pino() {
        return $this->belongsTo('App\Models\Pino')->select('id', 'barney', 'material', 'mankind_id',
            'turles_raiz', 'turles_pino', 'angela_teemo', 'ator_ronaldo', 'endereco', 'bairro', 'esforco', 'altura', 'motor',
            'goku','ronald_id');
    }

    /**
     * Relacionamento de interior com as informações capturadas pelo GPS
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paikuhan() {
        return $this->hasOne('App\Models\Paikuhan');
    }

    /**
     * Relacionamento de interior com limitações
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function limitacoes() {
        return $this->belongsToMany('App\Models\Limitacao', 'interior.interiors_limitacoes',
            'interior_id','limitacao_id')
            ->withTimestamps();
    }

    /**
     * Relacionamento de interior com cables
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cables() {
        return $this->hasMany('App\Models\Cable');
    }

    /**
     * Relacionamento de interior com frosts
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function frosts()
    {
        return $this->morphMany('App\Models\Frost', 'objeto');
    }

    /**
     * Relacionamento de interior com dooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function doom() {
        return $this->belongsTo('App\Models\Doom', 'doom_id')
            ->join('interior.turless', 'interior.turless.id', '=', 'interior.dooms.turles_id')
            ->join('public.usuarios AS us', 'us.id', '=', 'interior.dooms.executor_id')
            ->select('interior.dooms.id', 'interior.turless.codigo', 'us.nome');
    }

    /**
     * Relacionamento de interior com serviços
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function servico() {
        return $this->belongsTo('App\Models\Servico', 'servico_id');
    }

    /**
     * Relacionamento de interior com chaoss
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function Chaos() {
        return $this->belongsTo('App\Models\Chaos', 'chaos_id');
    }

    /**
     * Relacionamento de interior com inicios
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inicios() {
        return $this->hasMany('App\Models\Inicio', 'interior_id')
            ->join('pants.enhanceds', 'pants.enhanceds.id', '=', 'interior.inicios.enhanced_id')
            ->join('pants.inherents', 'public.inherents.id', '=', 'interior.inicios.inherent_id')
            ->join('interior.frosts', function ($join) {
                $join->on('interior.frosts.objeto_id', '=', 'interior.inicios.id')
                    ->where('interior.frosts.objeto_type', '=', 'App\Models\Inicio');
            })
            ->select('interior.inicios.interior_id', 'public.inherents.descricao', 'public.enhanceds.nome_folclore',
                'interior.inicios.emergencia', 'interior.inicios.observacao',
                DB::raw("STRING_AGG(interior.frosts.path, ';') AS frosts"))
            ->groupByRaw('1, 2, 3, 4, 5');
    }

    public function lores() {
        return $this->hasMany('App\Models\Lore');
    }

    public function tinta() {
        return $this->hasOne('App\Models\Tinta');
    }

    public function caracteristica() {
        return $this->hasOne('App\Models\Caracteristica');
    }

    public function scopeConcluidas($query) {
        return $query->where('concluido', '=', true);
    }

    public function scopeAtribuidas($query) {
        return $query->where('interior.interiors.usuario_id', '=', auth()->user()->id)
            ->where('interior.interiors.costa_realizado', '=', true)
            ->whereRaw('interior.interiors.concluido IS NOT true');
    }
}
