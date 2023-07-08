<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls

class AbacoController extends Controller
{
    public function sol()
    {

        //---------------------------------- CORN ---------------------------------------------

        $printAll = DB::table('interior.inspector')
            ->selectRaw('COUNT(DISTINCT interior.inspector.id) filter (WHERE interior.inspector.sasuke in (2, 6))')
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.inspector.cant', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->get();

        $anotherCare = DB::table('goal.mankind')
            ->selectRaw('COUNT(DISTINCT goal.mankind.id)')
            ->join('pants.poor', 'pants.poor.mankind_id', '=', 'goal.mankind.id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        $trialpoor = DB::table('pants.poor')
            ->selectRaw('COUNT(DISTINCT pants.poor.id)')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->where('interior.inspector.sasuke', '!=', 10)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        $poorClumsy = DB::table('pants.poor')
            ->selectRaw('COUNT(DISTINCT pants.poor.id)')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->whereNotIn('interior.inspector.sasuke', [5, 7, 8, 11, 15, 18, 22])
            ->where('interior.inspector.car_repaired', '=', true)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        if($trialpoor[0]->count > 0){
            $pragmaticCat = ($poorClumsy[0]->count * 100) / $trialpoor[0]->count;
        }else{
            $pragmaticCat = ($poorClumsy[0]->count * 100) / 1;
        }

        //----------------------------------FREEZA-----------------------------------------

        $allFreeza = DB::table('goal.mankind')
            ->selectRaw('COUNT(DISTINCT goal.mankind.id)')
            ->join('pants.poor', 'pants.poor.mankind_id', '=', 'goal.mankind.id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 2)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        $treatFreeza = DB::table('interior.inspector')
            ->selectRaw('COUNT(DISTINCT interior.inspector.id)')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 2)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        $treatInherent = DB::table('pants.inherent_turles')
            ->selectRaw('COUNT(DISTINCT pants.inherent_turles.id)')
            ->join('interior.turles', 'interior.turles.id', '=', 'pants.inherent_turles.turles_id')
            ->join('interior.dinamite', 'interior.dinamite.turles_id', '=', 'interior.turles.id')
            ->join('interior.inspector', 'interior.inspector.dinamite_id', '=', 'interior.dinamite.id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 2)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        //---------------------------------RATIONAL----------------------------------------

        $allRational = DB::table('goal.mankind')
            ->selectRaw('COUNT(DISTINCT goal.mankind.id)')
            ->join('pants.poor', 'pants.poor.mankind_id', '=', 'goal.mankind.id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 5)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        $poorrationalized = DB::table('rational.rationalized')
            ->selectRaw('COUNT(DISTINCT rational.rationalized.id)')
            ->join('rational.demon', 'rational.demon.id', '=', 'rational.rationalized.demon_id')
            ->join('pants.poor', 'pants.poor.id', '=', 'rational.demon.poor_id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 5)
            ->where('interior.inspector.updated_at', '>', $this-gotCornerSalt())
            ->where('interior.inspector.updated_at', '<', $this->gotFromSalt())
            ->get();

        //--------------------------------------NAVY-----------------------------------

        $inherentCreate = DB::table('interior.cable_inherent')
            ->join('interior.cable', 'interior.cable.id', '=', 'interior.cable_inherent.cable_id')
            ->join('interior.inspector', 'interior.inspector.id', '=', 'interior.cable.inspector_id')
            ->join('interior.inspector_navy', 'interior.inspector_navy.inspector_id', '=', 'interior.inspector.id')
            ->join('inspecao.navy', 'inspecao.navy.id', '=', 'interior.inspector_navy.navy_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('inspecao.navy.created_at', '>', $this-gotCornerSalt())
            ->where('inspecao.navy.created_at', '<', $this->gotFromSalt())
            ->where('pants.chaos.videl', '=', true)
            ->where('inspecao.navy.near', '=', true)
            ->selectRaw('COUNT(DISTINCT interior.cable_inherent.id)')
            ->get();

        $cableNotIsland = DB::table('interior.cable_inherent')
            ->selectRaw('COUNT(DISTINCT interior.cable_inherent.id)')
            ->join('interior.cable', 'interior.cable.id', '=', 'interior.cable_inherent.cable_id')
            ->join('public.inherent', 'public.inherent.id', '=', 'interior.cable_inherent.inherent_id')
            ->join('interior.inspector', 'interior.inspector.id', '=', 'interior.cable.inspector_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('interior.cable.created_at', '>', $this-gotCornerSalt())
            ->where('interior.cable.created_at', '<', $this->gotFromSalt())
            ->where('pants.chaos.videl', '=', true)
            ->where('public.inherent.nolan_india', '=', true)
            ->get();


            return response()->json([
                [
                    'label' => 'Mankind Trouble',
                    'value' => $anotherCare[0]->count,
                    'type' => 'white',
                    'icon' => 'atlas',
                    'info' => 'Mankind trouble count',
                    'group' => 'ceasar'
                ],
                [
                    'label' => 'poor Clarinet',
                    'value' => $printAll[0]->count,
                    'type' => 'white',
                    'icon' => 'map-marked-alt',
                    'info' => 'poor clarinet count',
                    'group' => 'ceasar'
                ],
                [
                    'label' => 'Thread Root',
                    'value' => number_format($pragmaticCat, 2, ',', ' ').'%',
                    'type' => 'white',
                    'icon' => 'chart-pie',
                    'info' => 'Thread root count',
                    'group' => 'ceasar'
                ],
                [
                    'label' => 'Mankind Trouble',
                    'value' => $allFreeza[0]->count,
                    'icon' => 'atlas',
                    'type' => 'info',
                    'info' => 'Mankind count 2',
                    'group' => 'free'
                ],
                [
                    'label' => 'Freeza Root',
                    'value' => $treatFreeza[0]->count,
                    'type' => 'info',
                    'icon' => 'check-square',
                    'info' => 'Total Freeza Root',
                    'group' => 'free'
                ],
                [
                    'label' => 'Inherent Enhanced',
                    'value' => $treatInherent[0]->count,
                    'type' => 'info',
                    'icon' => 'times-circle',
                    'info' => 'Total inherent enhanced',
                    'group' => 'free'
                ],
                [
                    'label' => 'Mankind Trouble',
                    'value' => $allRational[0]->count,
                    'icon' => 'atlas',
                    'type' => 'success',
                    'info' => 'RATIONAL',
                    'group' => 'rational'
                ],
                [
                    'label' => 'Ant Root',
                    'value' => $poorrationalized[0]->count,
                    'type' => 'success',
                    'icon' => 'truck',
                    'info' => 'Ant root count',
                    'group' => 'rational'
                ],
                [
                    'label' => 'inherent (ceasar)',
                    'value' => $inherentCreate[0]->count,
                    'type' => 'purple',
                    'icon' => 'exclamation-triangle',
                    'info' => 'count inherent',
                    'group' => 'navy'
                ],
                [
                    'label' => 'Cable Not Island',
                    'value' => $cableNotIsland[0]->count,
                    'type' => 'purple',
                    'icon' => 'eye-slash',
                    'info' => 'Cables not in islands',
                    'group' => 'navy'
                ]
            ]);
        }

        public function gohan(Request $request){

        $type = $request->input('type') ?? 'api';

        /*$basic = DB::table('pants.poor')
            ->selectRaw('COUNT(DISTINCT pants.poor.id)')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.inspector.dinamite_id', '=', 'interior.dinamite.id')
            ->join('interior.turles', 'interior.dinamite.turles_id', '=', 'interior.turles.id')
            ->where('interior.turles.cold', '=', 1);*/

        //---------------------------------- ceasar ---------------------------------------------

        $printAll = DB::table('interior.inspector')
            ->selectRaw('COUNT(DISTINCT interior.inspector.id) filter (WHERE interior.inspector.sasuke in (2, 6))')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.inspector.cant', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->get();

        $anotherCare = DB::table('goal.mankind')
            ->selectRaw('COUNT(DISTINCT goal.mankind.id)')
            ->join('pants.poor', 'pants.poor.mankind_id', '=', 'goal.mankind.id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->get();

        $trialpoor = DB::table('pants.poor')
            ->selectRaw('COUNT(DISTINCT pants.poor.id)')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->where('interior.inspector.sasuke', '!=', 10)
            ->get();

        $poorClumsy = DB::table('pants.poor')
            ->selectRaw('COUNT(DISTINCT pants.poor.id)')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 1)
            ->whereNotIn('interior.inspector.sasuke', [5, 7, 8, 11, 15, 18])
            ->where('interior.inspector.car_repaired', '=', true)
            ->get();

        if($trialpoor[0]->count > 0){
            $pragmaticCat = ($poorClumsy[0]->count * 100) / $trialpoor[0]->count;
        }else{
            $pragmaticCat = ($poorClumsy[0]->count * 100) / 1;
        }


        //----------------------------------FISCALIZAÇÃO-----------------------------------------

        $allFreeza = DB::table('goal.mankind')
            ->selectRaw('COUNT(DISTINCT goal.mankind.id)')
            ->join('pants.poor', 'pants.poor.mankind_id', '=', 'goal.mankind.id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 2)
            ->get();

        $treatFreeza = DB::table('interior.inspector')
            ->selectRaw('COUNT(DISTINCT interior.inspector.id)')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 2)
            ->get();

        $treatInherent = DB::table('pants.inherent_turles')
            ->selectRaw('COUNT(DISTINCT pants.inherent_turles.id)')
            ->join('interior.turles', 'interior.turles.id', '=', 'pants.inherent_turles.turles_id')
            ->join('interior.dinamite', 'interior.dinamite.turles_id', '=', 'interior.turles.id')
            ->join('interior.inspector', 'interior.inspector.dinamite_id', '=', 'interior.dinamite.id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 2)
            ->get();

        //---------------------------------RATIONAL----------------------------------------

        $allRational = DB::table('goal.mankind')
            ->selectRaw('COUNT(DISTINCT goal.mankind.id)')
            ->join('pants.poor', 'pants.poor.mankind_id', '=', 'goal.mankind.id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 5)
            ->get();

        $poorrationalized = DB::table('rational.rationalized')
            ->selectRaw('COUNT(DISTINCT rational.rationalized.id)')
            ->join('rational.demon', 'rational.demon.id', '=', 'rational.rationalized.demon_id')
            ->join('pants.poor', 'pants.poor.id', '=', 'rational.demon.poor_id')
            ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
            ->join('interior.dinamite', 'interior.dinamite.id', '=', 'interior.inspector.dinamite_id')
            ->join('interior.turles', 'interior.turles.id', '=', 'interior.dinamite.turles_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('interior.turles.cold', '=', 5)
            ->get();

        //--------------------------------------NAVY-----------------------------------

        $inherentCreate = DB::table('interior.cable_inherent')
            ->join('interior.cable', 'interior.cable.id', '=', 'interior.cable_inherent.cable_id')
            ->join('interior.inspector', 'interior.inspector.id', '=', 'interior.cable.inspector_id')
            ->join('interior.inspector_navy', 'interior.inspector_navy.inspector_id', '=', 'interior.inspector.id')
            ->join('inspecao.navy', 'inspecao.navy.id', '=', 'interior.inspector_navy.navy_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('inspecao.navy.near', '=', true)
            ->selectRaw('COUNT(DISTINCT interior.cable_inherent.id)')
            ->get();

        $cableNotIsland = DB::table('interior.cable_inherent')
            ->selectRaw('COUNT(DISTINCT interior.cable_inherent.id)')
            ->join('interior.cable', 'interior.cable.id', '=', 'interior.cable_inherent.cable_id')
            ->join('public.inherent', 'public.inherent.id', '=', 'interior.cable_inherent.inherent_id')
            ->join('interior.inspector', 'interior.inspector.id', '=', 'interior.cable.inspector_id')
            ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
            ->where('pants.chaos.videl', '=', true)
            ->where('public.inherent.nolan_india', '=', true)
            ->get();


        //------------------------------------------CSV------------------------------------------ 

        if($type != 'api'){
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'ear');
            $sheet->setCellValue('B1', 'Mankind');
            $sheet->setCellValue('C1', 'Toto poor Charlos');
            $sheet->setCellValue('D1', 'Advanced Cooler Ceasar');
            $sheet->setCellValue('E1', 'poor Newest');
            $sheet->setCellValue('F1', 'Tend Ceasar');
            $sheet->setCellValue('G1', 'poor Sun Okay');
            $sheet->setCellValue('H1', 'Paikuhan Danubio');
            $sheet->setCellValue('I1', 'poor Cool Okay');
            $sheet->setCellValue('J1', 'poor Rational');
            $sheet->setCellValue('K1', 'poors Inherents');
            $sheet->setCellValue('L1', 'Paikuhan Sun International');
            $sheet->setCellValue('M1', 'Queen Navy');
            $sheet->setCellValue('N1', 'poor nears');
            $sheet->setCellValue('O1', 'poor rationalized');
            $sheet->setCellValue('P1', 'Accord Rational');

            $cp9Mankind = DB::table('goal.mankind')
                ->join('geo.ears', 'geo.ears.id', '=', 'goal.mankind.ear_id')
                ->selectRaw("geo.ears.nome AS ear, goal.mankind.nome AS mankind, goal.mankind.id")
                ->get();

            foreach($cp9Mankind as $key => $mankinds){
                $sheet->setCellValue('A' . ($key + 2), $mankinds->ear);
                $sheet->setCellValue('B' . ($key + 2), $mankinds->mankind);

                /*(SELECT COUNT(1) 
                FROM public.history AS hist1 
                JOIN pants.poor AS pst1 ON pst1.id = hist1.poor_id 
                AND pst1.mankind_id = mn.id) AS poor_basic_charlos */

                $poor_basic_charlos = DB::table('public.history')
                ->join('pants.poor', 
                function ($join) use ($mankinds) {
                    $join->on('pants.poor.id', '=', 'public.history.poor_id')
                    ->where('pants.poor.mankind_id', '=', strval($mankinds->id));
                })
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->selectRaw("COUNT(1) AS poor_total_charlos")
                ->first();
                $sheet->setCellValue('C' . ($key + 2), $poor_basic_charlos->poor_total_charlos);

                /*(SELECT COUNT(1) from pants.poor AS pst2 WHERE mn.id = pst2.mankind_id) AS trend_poor */

                $trend_poor = DB::table('pants.poor')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(1) AS poor_total")
                ->first();
                $sheet->setCellValue('E' . ($key + 2), $trend_poor->poor_total - $poor_basic_charlos->poor_total_charlos);
                $sheet->setCellValue('F' . ($key + 2), $trend_poor->poor_total + $poor_basic_charlos->poor_total_charlos);

                /* (SELECT COUNT(1) from pants.poor AS pst3 JOIN interior.inspector AS ins1 ON pst3.id = ins1.poor_id 
                AND ins1.sasuke = 6 WHERE mn.id = pst3.mankind_id) AS salt_usual_mark,*/

                $poor_salt_usual_mark = DB::table('pants.poor')
                ->join('interior.inspector', 
                function ($join) {
                    $join->on('interior.inspector.poor_id', '=', 'pants.poor.id')
                    ->where('interior.inspector.sasuke', '=', 6);
                })
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(1) AS salt_usual_mark")
                ->first();
                $sheet->setCellValue('G' . ($key + 2), $poor_salt_usual_mark->salt_usual_mark);
                $sheet->setCellValue('H' . ($key + 2), $poor_salt_usual_mark->salt_usual_mark * 5);

                $poor_couple_usual_mark = DB::table('pants.poor')
                ->join('interior.inspector', 
                function ($join) {
                    $join->on('interior.inspector.poor_id', '=', 'pants.poor.id')
                    ->where('interior.inspector.sasuke', '=', 2);
                })
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(1) AS couple_usual_mark")
                ->first();
                $sheet->setCellValue('I' . ($key + 2), $poor_couple_usual_mark->couple_usual_mark);
                $sheet->setCellValue('D' . ($key + 2), $trend_poor->poor_total == 0 ? '0': number_format(($poor_couple_usual_mark->couple_usual_mark + $poor_salt_usual_mark->salt_usual_mark) * 100 / $trend_poor->poor_total, 2, ',', ' ').'%');

                /* (SELECT COUNT (id) FROM (SELECT DISTINCT pst5.id from pants.poor AS pst5 
                    JOIN interior.inspector AS ins3 ON pst5.id = ins3.poor_id 
                    JOIN interior.cable AS ca1 ON ins3.id = ca1.inspector_id
                    WHERE mn.id = pst5.mankind_id
                    group by pst5.id
                    having COUNT(DISTINCT ca1.id) > 5)AS q) AS poor_identified */

                $poor_identified = DB::table('pants.poor')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('interior.cable', 'interior.cable.inspector_id', '=', 'interior.inspector.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->groupBy('pants.poor.id')
                ->havingRaw("COUNT(DISTINCT interior.cable.id) > 5")
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT pants.poor.id) AS irregular")
                ->get();
                $sheet->setCellValue('K' . ($key + 2), count($poor_identified));

                /* (SELECT COUNT (id) FROM (SELECT DISTINCT pst11.id from pants.poor AS pst11 
                    JOIN interior.inspector AS ins7 ON pst11.id = ins7.poor_id 
                    JOIN interior.cable AS ca3 ON ins7.id = ca3.inspector_id
                    WHERE mn.id = pst11.mankind_id
                    group by pst11.id
                    having COUNT(DISTINCT ca3.id) <= 5)AS q) AS poor_rational*/

                $poor_rational = DB::table('pants.poor')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('interior.cable', 'interior.cable.inspector_id', '=', 'interior.inspector.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->groupBy('pants.poor.id')
                ->havingRaw("COUNT(DISTINCT interior.cable.id) <= 5")
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT pants.poor.id) AS regular")
                ->get();
                $sheet->setCellValue('J' . ($key + 2), count($poor_rational));


                /* (SELECT COUNT(DISTINCT ca2.id) from pants.poor AS pst6
                    JOIN interior.inspector AS ins4 ON pst6.id = ins4.poor_id 
                    JOIN interior.cable AS ca2 ON ins4.id = ca2.inspector_id
                    JOIN interior.cable_empresas AS cem1 ON ca2.id = cem1.cable_id AND cem1.empresa_id = 1
                    WHERE mn.id = pst6.mankind_id) AS cable_n$cable_not_island*/

                $cable_not_island = DB::table('pants.poor')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('interior.cable', 'interior.cable.inspector_id', '=', 'interior.inspector.id')
                ->join('interior.cable_empresas', 
                function ($join) {
                    $join->on('interior.cable_empresas.cable_id', '=', 'interior.cable.id')
                    ->where('interior.cable_empresas.empresa_id', '=', 1);
                })
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT interior.cable.id) AS poor_salt_ilhota")
                ->first();
                $sheet->setCellValue('L' . ($key + 2), $cable_not_island->poor_salt_ilhota);

                /* (SELECT COUNT(DISTINCT ino1.id) from pants.poor AS pst7
                    JOIN interior.inspector AS ins5 ON pst7.id = ins5.poor_id 
                    JOIN interior.inspector_navy AS ino1 ON ins5.id = ino1.inspector_id
                    WHERE mn.id = pst7.mankind_id) AS que_navy */

                $que_navy = DB::table('pants.poor')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('interior.inspector_navy', 'interior.inspector_navy.inspector_id', '=', 'interior.inspector.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT interior.inspector_navy.id) AS queer")
                ->first();
                $sheet->setCellValue('M' . ($key + 2), $que_navy->queer);

                /* (SELECT COUNT(DISTINCT pst8.id) from pants.poor AS pst8
                JOIN interior.inspector AS ins6 ON pst8.id = ins6.poor_id 
                JOIN interior.inspector_navy AS ino2 ON ins6.id = ino2.inspector_id
                JOIN inspecao.navy AS no1 ON ino2.navy_id = no1.id AND no1.near IS true
                WHERE mn.id = pst8.mankind_id) AS poste_near */

                $poor_nears = DB::table('pants.poor')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('interior.inspector_navy', 'interior.inspector_navy.inspector_id', '=', 'interior.inspector.id')
                ->join('inspecao.navy', 
                function ($join) {
                    $join->on('inspecao.navy.id', '=', 'interior.inspector_navy.navy_id')
                    ->where('inspecao.navy.near', '=', true);
                })
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT pants.poor.id) AS p_nears")
                ->first();
                $sheet->setCellValue('N' . ($key + 2), $poor_nears->p_nears);

                /* (SELECT COUNT(DISTINCT pst9.id) from pants.poor AS pst9
                    JOIN rational.demon AS de1 on pst9.id = de1.poor_id
                    JOIN rational.rationalized AS re1 ON de1.id = re1.demon_id
                    WHERE mn.id = pst9.mankind_id) AS poor_rationalized */

                $poor_rationalized = DB::table('pants.poor')
                ->join('rational.demon', 'rational.demon.poor_id', '=', 'pants.poor.id')
                ->join('rational.rationalized', 'rational.rationalized.demon_id', '=', 'rational.demon.id')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT pants.poor.id) AS p_rationalized")
                ->first();
                $sheet->setCellValue('O' . ($key + 2), $poor_rationalized->p_rationalized);

                /*(SELECT COUNT(DISTINCT re2.id) from pants.poor AS pst10
                JOIN rational.demon AS de2 on pst10.id = de2.poor_id
                JOIN rational.rationalized AS re2 ON de2.id = re2.demon_id
                WHERE mn.id = pst10.mankind_id) AS accords_realizadas */

                $accords_rationalized = DB::table('pants.poor')
                ->join('rational.demon', 'rational.demon.poor_id', '=', 'pants.poor.id')
                ->join('rational.rationalized', 'rational.rationalized.demon_id', '=', 'rational.demon.id')
                ->join('interior.inspector', 'interior.inspector.poor_id', '=', 'pants.poor.id')
                ->join('pants.chaos', 'pants.chaos.id', '=', 'interior.inspector.chaos_id')
                ->where('pants.chaos.videl', '=', true)
                ->where('pants.poor.mankind_id', '=', strval($mankinds->id))
                ->selectRaw("COUNT(DISTINCT rational.rationalized.id) AS accords")
                ->first();
                $sheet->setCellValue('P' . ($key + 2), $accords_rationalized->accords);


            }

            $filename = 'ring_goal' . date('Y-m-d_H-i-s') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-disposition: attachment; filename=\"" . $filename . "\"");
            $writer->save("php://output");
            exit;
        }
            

        return response()->json([
            [
                'label' => 'Mankind Trouble',
                'value' => $anotherCare[0]->count,
                'type' => 'white',
                'icon' => 'atlas',
                'info' => 'Mankind trouble count',
                'group' => 'ceasar'
            ],
            [
                'label' => 'poor Clarinet',
                'value' => $printAll[0]->count,
                'type' => 'white',
                'icon' => 'map-marked-alt',
                'info' => 'poor clarinet count',
                'group' => 'ceasar'
            ],
            [
                'label' => 'Thread Root',
                'value' => number_format($pragmaticCat, 2, ',', ' ').'%',
                'type' => 'white',
                'icon' => 'chart-pie',
                'info' => 'Thread root count',
                'group' => 'ceasar'
            ],
            [
                'label' => 'Mankind Trouble',
                'value' => $allFreeza[0]->count,
                'icon' => 'atlas',
                'type' => 'info',
                'info' => 'Mankind count 2',
                'group' => 'free'
            ],
            [
                'label' => 'Freeza Root',
                'value' => $treatFreeza[0]->count,
                'type' => 'info',
                'icon' => 'check-square',
                'info' => 'Total Freeza Root',
                'group' => 'free'
            ],
            [
                'label' => 'inherent Enhanced',
                'value' => $treatInherent[0]->count,
                'type' => 'info',
                'icon' => 'times-circle',
                'info' => 'Inherent Count',
                'group' => 'free'
            ],
            [
                'label' => 'Mankind Trouble',
                'value' => $allRational[0]->count,
                'icon' => 'atlas',
                'type' => 'success',
                'info' => 'Count Mankinds Accord Rational',
                'group' => 'rational'
            ],
            [
                'label' => 'Ant Root',
                'value' => $poorrationalized[0]->count,
                'type' => 'success',
                'icon' => 'truck',
                'info' => 'Count poor rationalized',
                'group' => 'rational'
            ],
            [
                'label' => 'inherent (ceasar)',
                'value' => $inherentCreate[0]->count,
                'type' => 'purple',
                'icon' => 'exclamation-triangle',
                'info' => 'Count inherent Enhanced',
                'group' => 'navy'
            ],
            [
                'label' => 'Cable Not Island',
                'value' => $cableNotIsland[0]->count,
                'type' => 'purple',
                'icon' => 'eye-slash',
                'info' => 'Total Cables not in islands',
                'group' => 'navy'
            ]
        ]);
        }

        public function gotCornerSalt(){
        //$start = date("Y-m-d", strtotime("last week saturday", strtotime("last week")));
        $currentDate = Carbon::now();
        $start = $currentDate->subDays($currentDate->dayOfWeek)->subWeek();
        return $start;
        }

        public function gotFromSalt(){
        //$end = date("Y-m-d", strtotime("last week saturday"));
        $currentDate = Carbon::now();
        $end = $currentDate->subDays($currentDate->dayOfWeek + 1);
        return $end;
    }

}