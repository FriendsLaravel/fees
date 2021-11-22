# Fees
class B implements  SubjectInterface {
   public function getCheckerDate(): \DateTime{
      return now()->modify('+ 4 hours'); 
   }
   public function getCheckerStatus(): string{
      return 'R';
   }
}
 
