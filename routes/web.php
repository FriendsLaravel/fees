<?php


use Fol\Fees\Models\SubjectInterface;
use Illuminate\Support\Facades\Route;

/* class B implements  SubjectInterface {
   public function getCheckerDate(): \DateTime{
      return now()->modify('+ 4 hours'); 
   }

   public function getCheckerStatus(): string{
      return 'R';
   }
}
 */



Route::group(['middleware' => ['web','auth'],'namespace'=> 'Fol\Fees\Http\Controllers'],function(){
   Route::apiresource('fees',FeesController::class);


  /*  Route::get('test', function(){
      $fees = isEligibleFees(new B());
      dd($fees->calculator(1000));
     return 'fin';
   }); */
});


