<?php

namespace App\Services\boats;

use App\Models\boats\Boat;
use App\Models\boats\BoatType;
use App\Models\persons\Person;
use App\Models\users\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoatService
{

    public function showBoatsByOwner($ownerId){
        $owner = Person::find($ownerId);
        return $owner->boats();

    }
    public function showBoatsByUser($userId){
        $user = User::find($userId);

        return DB::table('boat')
            ->join('user_person','user_person.person_id','=','boat.person_id')
            ->join('user','user.id','=','user_person.user_id')
            ->select('boat.*')->get();

    }
    public function store($params, int $ownerId){

        $boat = new Boat($params);

        $boat_type = BoatType::where('name', $params['boat_type'])->first();

        $owner = Person::find($ownerId);

        $boat->boatType()->associate($boat_type);


        return $owner->boats()->save($boat);

    }

    public function show($id){

        return Boat::find($id);

    }

    public function update($params, int $boatId){

        $boat= Boat::find($boatId);

        return $boat->update($params);
    }

    public function destroy($boatId){

        $boat = Boat::find($boatId);

        return $boat->delete();
    }

}