<?php

namespace App\Http\Controllers\Statics;

use App\Models\User;
use Illuminate\Routing\Controller;


class StaticController extends Controller
{
    public function create()
    {
        $gameStrategy = [
            'labels' => [
                'Folded On PreFlop',
                'Folded On Flop',
                'Folded On Turn',
                'Folded On River',
                'ShowDown',
                'Won Without ShowDown',
            ],
            'data' => []
        ];
        $sngTotal = [
            'labels' => [
                'Win Count',
                'Lose Count',
            ],
            'data' => []
        ];
        $cashGameWinLoseStates = [
            'labels' => [
                'Win Count',
                'Lose Count',
            ],
            'data' => []
        ];
        $ringGameStatsData = User::query()->find(auth()->id())->ringGameStats()->first();
        $sngStatsData = User::query()->find(auth()->id())->sngStats()->first();
        if ($ringGameStatsData) {
            $gameStrategy['data'] = [
                $ringGameStatsData->folded_on_preflop_count,
                $ringGameStatsData->folded_on_flop_count,
                $ringGameStatsData->folded_on_turn_count,
                $ringGameStatsData->folded_on_river_count,
                $ringGameStatsData->showdown_count,
                $ringGameStatsData->won_without_showdown_count,

            ];
            $cashGameWinLoseStates['data'] = [
                $ringGameStatsData->win_count,
                $ringGameStatsData->lose_count,
            ];
        }
        if ($sngStatsData) {
            $sngTotal['data'] = [
                $sngStatsData->win_count,
                $sngStatsData->lose_count,
            ];
        }
        return view('statics', [
            'gameStrategy' => $gameStrategy,
            'sngStats' => $sngTotal,
            'cashGameWinLoseStates' => $cashGameWinLoseStates,
        ]);
    }
}
