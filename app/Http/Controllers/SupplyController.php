<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SupplyRepository;
use Carbon\Carbon;

class SupplyController extends Controller
{

    protected $supplyRepository = null;
    
    public function __construct (SupplyRepository $repository)
    {
        $this->supplyRepository = $repository;
    }
    
    public function index ()
    {
        $supplies = $this->supplyRepository->all();
        // $date = new Carbon('-3 months');
        // return ( $supplies );
        $user = Auth::user();
        if($user->role == "ADMIN")
            return view('admin.supply.index', ['supplies' => $data]);
        
        return view('supply.index', ['supplies' => $data]);
    }

    public function show ( $id )
    {
        $supply = $this->supplyRepository->find( $id );
        // dd( $supply );
        return view('admin.supply.show', ['supply' => $supply]);
    }

    public function create ()
    {
        return view('admin.supply.create');
    }

    public function edit ( $id )
    {
        $supply = $this->supplyRepository->find( $id );
        // dd( $supply );
        return view('admin.supply.edit',['supply' => $supply]);
    }

    public function store( $id )
    {
        $this->supplyRepository->create( $id );
    }

    public function destroy ( $id )
    {
        $supply = $this->supplyRepository->delete( $id );
        dd( $supply );
    }

    public function update(Request $request, $id)
    {
        $supply = $supplyRepository->update( $request->all() , $id );
    
    }
}
