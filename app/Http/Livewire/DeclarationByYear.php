<?php

namespace App\Http\Livewire;

use App\Models\Declaration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeclarationByYear extends Component
{
    public $declarationByYear ;
    public $declarationByYearData ;
    public $declarationByYearLabels  ;
    public $declarationByMonth ;
    public $declarationByYearMonth ;
    public $declarationByUser ;
    public $declarationByOffice ;
    public $declarationByPost ;
    public $declarationBySchedule ;

    public function mount()
    {
        $this->declarationByYearData = collect([]);
        $this->declarationByYearLabels = collect([]);

        $this->declarationByYear = Declaration::select(DB::raw('year(declared_on) as Year, count(*) as Number') )
            ->groupBy(DB::raw('Year'))
            ->orderBy('Number', 'desc')
            ->orderBy('Year', 'desc')
            ->limit(12)
            ->get();

        $this->declarationByYear->each( function ($item, $key){
            $this->declarationByYearLabels->push(collect($item->toArray())->values()->first());
            $this->declarationByYearData->push(collect($item->toArray())->values()[1]);
            // $this->declarationByYearLabels->push($item->keys());
        });
        // $this->declarationByYearLabels = $declarationByYear->keys();

        $this->declarationByYearMonth = Declaration::select(DB::raw('year(declared_on) as Year, month(declared_on) as Month , count(*) as Number') )
            ->groupBy(DB::raw('Year, Month'))
            ->orderBy('Year', 'desc')
            ->orderBy('month')
            ->get();

        $this->declarationByMonth = Declaration::select(dB::raw('month(declared_on) as Month, count(*) as Number'))
            ->groupBy(DB::raw('Month'))
            ->get() ;

        $this->declarationByUser = Declaration::select('user_id',dB::raw('count(*) as Number'))
            ->groupBy('user_id')
            ->orderBy('Number', 'desc')
            ->get() ;

        $this->declarationByOffice = Declaration::select('office_id',dB::raw('count(*) as Number'))
            ->groupBy('office_id')
            ->orderBy('Number', 'desc')
            ->get() ;

        $this->declarationByPost = Declaration::select('post',dB::raw('count(*) as Number'))
            ->groupBy('post')
            ->orderBy('Number', 'desc')
            ->get() ;

        $this->declarationBySchedule = Declaration::select('schedule',dB::raw('count(*) as Number'))
            ->groupBy('schedule')
            ->orderBy('Number', 'desc')
            ->get() ;
    }

    public function render()
    {
        return view('livewire.declaration-by-year')->layout('layouts.guest');
    }
}
