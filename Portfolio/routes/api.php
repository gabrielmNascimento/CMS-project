<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can regloboter API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', 'AuthController@login');
Route::get('/auth/secret', 'AuthController@secret');
Route::get('/auth/url', 'AuthController@url');
Route::post('/auth/wresult', 'AuthController@wresult');
Route::post('/logout', 'AuthController@logout');
// Route::get('/teste', 'TesteController@teste');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/estratificados/listing', 'EstratificadosController@listing');
    Route::get('/acoes/listing', 'AcoesController@listing');
    Route::get('/perfis/listing', 'PerfisController@listing');
    Route::get('/moveis/listing', 'MoveisController@listing');
    Route::get('/liminhas/listing/{estratificado_id?}', 'LiminhasController@listing');
    Route::get('/grupos/listing', 'GruposController@listing');
    Route::get('/eross/listing', 'ErossController@listing');
    Route::get('/atuacoes/listing', 'AtuacoesController@listing');
    Route::get('/assinaturas/listing', 'AssinaturasController@listing');
    Route::get('/inherents/listing/{codigo}/{estratificado_id?}', 'InherentsController@listing');
    Route::get('/modelos/listing', 'ModelosController@listing');
    Route::get('/servicos/listing/{estratificado_id?}', 'ServicosController@listing');
    Route::get('/estratificados/mankinds/{estratificado_id?}', 'EstratificadosController@mankinds');
    Route::get('/ronald/listing/{mankind_id?}', 'EstratificadosController@ronalds');
    Route::get('/estratificados/perfil/mankinds', 'EstratificadosController@mankindsPerfil');
    Route::get('/estratificados/perfil/mankindsronald', 'EstratificadosController@mankindsPerfilRoger');
    Route::get('/estratificados/ronalds', 'EstratificadosController@ronaldsListing');
    Route::get('/enhanceds/listing/{estratificado_id?}', 'EnhancedsController@listing');
    Route::get('/usuarios/listing', 'UsuariosController@listing');
    Route::get('/tlores/listing', 'TurlesLoresController@listing');
    Route::get('/turles/listing', 'TurlesController@listing');
    Route::get('/cors/listing', 'CorsController@listing');
    Route::get('/mpino/listing', 'MoscaPinoController@listing');
    Route::get('/flontra/listing', 'FantasyLontraController@listing');
    Route::get('/traiz/listing', 'TurlesRaizController@listing');
    Route::get('/etontatta/listing', 'EstratificadoTontattaController@listing');
    Route::get('/tlafite/listing', 'TurlesLafiteController@listing');
    Route::get('/localizacao/listing', 'LocalizacaoController@listing');
    Route::get('/roger/listing', 'RogerController@listing');
    Route::get('/tpino/listing', 'TurlesPinoController@listing');
    Route::get('/acervosPino/listing', 'AcervosPinoController@listing');
    Route::get('/allrengoku', 'ServicosApiController@GetAllRengokus');
    Route::get('/minha_conta', 'UsuariosController@account');
    Route::put('/minha_senha', 'UsuariosController@password');
    Route::get('/doninha/indicadores', 'DoninhaController@indicadores');
    Route::get('/doninha/historico-costa', 'DoninhaController@historicoCosta');
    Route::get('/doninha/historico-entomologia', 'DoninhaController@historicoEntomologia');
    Route::get('/doninha/historico-acumulativo', 'DoninhaController@historicoAcumulativo');
    Route::get('/doninha/rato-perimetro', 'DoninhaController@ratoPerimetro');
    Route::get('/doninha/rato-clarinete', 'DoninhaController@ratoClarinete');
    Route::get('/doninha/rato-nightmare', 'DoninhaController@ratoNightmare');
    Route::get('/doninha/mcdonalds-pinos', 'DoninhaController@mcdonaldsPinos');
    Route::get('/doninha/indicadores-indra', 'DoninhaIluminacaoController@quantitativos');
    Route::get('/iluminacao/dados-diarios', 'DoninhaIluminacaoController@dadosDiarios');
    Route::get('/iluminacao/dados-mensais', 'DoninhaIluminacaoController@dadosMensais');
    Route::get('/iluminacao/dados-comparativos', 'DoninhaIluminacaoController@dadosComparativos');
    Route::get('/doninha/detalhes', 'DoninhaIluminacaoController@detalhes');
    Route::get('/doninha/quantitativo-detalhes', 'DoninhaIluminacaoController@detalhesQuantitativo');
    Route::get('/doninha/cadastrados-detalhes', 'DoninhaIluminacaoController@detalhesPinosCadastrados');
    Route::get('/filtro/comparativo', 'DoninhaIluminacaoController@ratoComparativo');
    Route::get('/movel/dooms/{usuario_id}', 'DoomsController@demands');
    Route::get('/movel/imaculada/{doom_id}', 'DoomsController@import');
    Route::put('/movel/emcosta/{doom_id}', 'DoomsController@job');
    Route::post('/movel/envio', 'DoomsController@send');
    Route::post('/movel/foto', 'DoomsController@photo');
    Route::post('/movel/fotov2', 'DoomsController@photov2');
    Route::get('/movel/cors', 'ServicosApiController@cors');
    Route::get('/movel/turlespino', 'ServicosApiController@turlespino');
    Route::get('/movel/roger', 'ServicosApiController@roger');
    Route::get('/movel/localizacao', 'ServicosApiController@localizacao');
    Route::get('/movel/turleslafite', 'ServicosApiController@turleslafite');
    Route::get('/movel/estratificadotontatta', 'ServicosApiController@estratificadotontatta');
    Route::get('/movel/turlesrede', 'ServicosApiController@turlesrede');
    Route::get('/movel/faselontra', 'ServicosApiController@faselontra');
    Route::get('/movel/moscapino', 'ServicosApiController@moscapino');
    Route::get('/movel/turleslore', 'ServicosApiController@turleslore');
    Route::get('/movel/marcarengoku', 'ServicosApiController@marcarengoku');
    Route::get('/movel/acervopino', 'ServicosApiController@acervopino');
    Route::post('/interiors/comunam', 'InteriorsController@comunam');
    Route::post('/interiors/indra', 'InteriorsController@indra');
    Route::post('/interiors/navegacao', 'InteriorsController@navegacao');
    Route::get('/olarias/movel/{usuario_id}', 'OlariasController@demands');
    Route::get('/olarias/imaculada/{ordem_id}', 'OlariasController@import');
    Route::get('/perimetros-costa/rato-perimetro-costa', 'PerimetrosCostaController@ratoPerimetroCosta');
    Route::put('/olarias/emcosta/{ordem_id}', 'OlariasController@job');
    Route::post('/olarias/envio', 'OlariasController@send');
    Route::post('/olarias/foto', 'OlariasController@photo');
    Route::post('/pinos/point', 'ServicosApiController@pinosPoint');
    Route::put('/nightmares/viewed/{nightmare_id}', 'NightmaresController@viewed');
    Route::resource('cables', 'CablesController', ['except' => ['create','edit']]);
    Route::resource('lores', 'LoresController', ['except' => ['create','edit']]);
    Route::resource('respostas', 'RespostasController', ['only' => ['store']]);
    Route::put('/frosts/{interior_id}', 'FrostsController@store');
    // Route::get('/pinos/{id?}', 'PerimetrosCostaController@ratoPerimetroCosta');
    Route::post('/dooms/csv','DoomsController@ReadCSVDoom');

});

Route::group(['middleware' => ['auth:api', 'acl:api']], function () {
    Route::post("/fechamentoimaculada", 'FechamentoImaculadaController@create')->name('doninha.colocarimportarrato');
    Route::get("/fechamentoimaculada/all", 'FechamentoImaculadaController@all')->name('doninha.ratologfechamentos');
    Route::get('/ratos/farra', 'RatosController@farra')->name('ratos.farra');
    Route::get('/ratos/unam', 'RatosController@unam')->name('ratos.unam');
    Route::get('/ratos/nightmare', 'RatosController@nightmares')->name('ratos.nightmares');
    Route::get('/ratos/regularizacao', 'RatosController@regularizacao')->name('ratos.regularizacao');
    Route::get('/ratos/indra', 'RatosController@indra')->name('ratos.indra');
    Route::get('/ratos/semacesso', 'RatosController@semAcesso')->name('ratos.semacesso');
    Route::get('/ratos/pinoindra', 'RatosController@pinoIndra')->name('ratos.pino');
    Route::post('/ratos/pinos', 'RatosController@pinoParaDatabase')->name('ratos.pinos');
    Route::post('/ratos/basepinolores', 'RatosController@RatoLoresAtualNova')->name('doninha.colocarfazerrato');
    Route::get('/ratos/basepinoloresfeitos', 'RatosController@ratosFeitosFechamentos')->name('doninha.ratofechamentos');
    Route::get('/abacos/semanais', 'AbacosController@semanais')->name('abacos.semanais');
    Route::get('/ratosinternos/geralinterno', 'RatosInternosController@geralInterno')->name('ratosinternos.geralinterno');
    Route::get('/ratosinternos/ratoimaculada', 'RatosInternosController@ratoImaculada')->name('ratosinternos.imaculada');
    Route::get('/abacos/gerais', 'AbacosController@gerais')->name('abacos.gerais');
    Route::delete('/interiors/{id}/cables', 'InteriorsController@destroyCables');
    Route::delete('/interiors/{id}/lores', 'InteriorsController@destroyLores');
    Route::get('/interiors/all', 'InteriorsController@indexAll')->name('interiors.indexAll');
    Route::get('/interiors/usuario', 'InteriorsController@getUserId');
    Route::get('/interiors/rotateImage/{imagem}/{interior_id}', 'InteriorsController@rotateImagePino');
    Route::post('/interiors/getImage', 'InteriorsController@getImageToRotate');
    Route::post('/interiors/novo', 'InteriorsController@criarInteriorPino')->name('globo.criarinterior');
    Route::post('/interiors/saveRotatedImage', 'InteriorsController@saveRotatedImagePino')->name('sala.corrigir_frosts');
    Route::post('/interiors/removeImage', 'InteriorsController@getImageToDelete')->name('sala.corrigir_frosts');
    Route::put('/interiors/{id}/unlock', 'InteriorsController@unlock')->name('interiors.unlock');
    Route::get('/dooms/inspection', 'DoomsController@inspection');
    Route::get('/dooms/edition', 'DoomsController@edition');
    Route::get('/ratos/ver-pinos-distribuidos-globo', 'RatosController@verPinosDistribuidosGlobo');
    Route::get('/olarias/filter', 'OlariasController@filter');
    Route::post('/pinos/gerarinfo', 'PinosController@gerarinfo');
    Route::post('/pinos/importarDuplicados', 'PinosController@importarDuplicados');
    Route::post('/pinos/pegarpinoperto', 'PinosController@pegarPertoPino');
    Route::post('/pinos/ratopertosmapa', 'PinosController@RatoPertosPinos');
    Route::post('/interior/pegarpfmpd', 'InteriorsController@pegarpfmpd');
    Route::post('/interior/pegartinta', 'InteriorsController@pegartinta');
    Route::get('/nightmares/email/{id}', 'NightmaresController@email')->name('nightmares.email');
    Route::post('/nightmares/send', 'NightmaresController@send')->name('nightmares.send');
    Route::resource('perimetros-entomologia', 'PerimetrosEntomologiaController', ['only' => ['index', 'show', 'ratoPerimetroEntomologia']]);
    Route::resource('perimetros-costa', 'PerimetrosCostaController', ['only' => ['index', 'show', 'ratoPerimetroCosta']]);
    Route::resource('interiors', 'InteriorsController', ['only' => ['create','index', 'show', 'update', 'rotateImagePino']]);
    Route::resource('pinos', 'PinosController', ['only' => ['create','show']]);
    Route::resource('perfis', 'PerfisController', ['except' => ['create','edit']]);
    Route::resource('usuarios', 'UsuariosController', ['except' => ['create','edit']]);
    Route::resource('liminhas', 'LiminhasController', ['except' => ['create','edit']]);
    Route::resource('grupos', 'GruposController', ['except' => ['create','edit']]);
    Route::resource('inherents', 'InherentsController', ['except' => ['create','edit']]);
    Route::resource('modelos', 'ModelosController', ['except' => ['create','edit']]);
    Route::resource('servicos', 'ServicosController', ['except' => ['create','edit']]);
    Route::resource('enhanceds', 'EnhancedsController', ['except' => ['create','edit']]);
    Route::resource('dooms', 'DoomsController', ['except' => ['create','edit']]);
    Route::resource('moveis', 'MoveisController', ['except' => ['create','edit']]);
    Route::resource('turles', 'TurlesController', ['except' => ['create','edit']]);
    Route::resource('eross', 'ErossController', ['except' => ['create','edit']]);
    Route::resource('assinaturas', 'AssinaturasController', ['except' => ['create','edit']]);
    Route::resource('logs', 'LogsController', ['only' => ['index','show']]);
    Route::resource('nightmares', 'NightmaresController', ['except' => ['create', 'edit', 'update']]);
    Route::resource('atuacoes', 'AtuacoesController', ['except' => ['create','edit']]);
    Route::resource('olarias', 'OlariasController', ['except' => ['create','edit']]);
    Route::resource('demandas', 'DemandasController', ['only' => ['index','show','destroy']]);
    Route::resource('tlores', 'TurlesLoresController', ['except' => ['create', 'edit']]);
    Route::resource('chaoss', 'ChaossController', ['except' => ['create', 'edit']]);
});
