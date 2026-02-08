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
    public function showBoatsByUser(User $user){
        $person = $user->persons()->first();

        return $person->boats;

    }
    public function store($params, $user){

        $boat = new Boat($params);

        $boat_type = BoatType::where('name', $params['boat_type'])->first();

        $person = $user->persons()->first();

        $boat->boatType()->associate($boat_type);

        return $person->boats()->save($boat);

    }

    public function show($id){

        return Boat::find($id);

    }

    public function update($params, $user,int $boatId){

        $boat= Boat::find($boatId);

        return $boat->update($params);
    }

    public function destroy($boatId){

        $boat = Boat::find($boatId);

        return $boat->delete();
    }

}