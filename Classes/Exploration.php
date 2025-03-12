<?php
class Exploration{
    private $id; 
    private $exploration_date; 
    private $longitude; 
    private $latitude; 
    
    
    public function __construct($id){
        $this->id = $id;
    }
    public static function getOne($id)
    {
        $request = DB::connect()->prepare("select * from exploration where id = ?");
        $request->execute([$id]);
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        $theChosenOne = new Exploration
        (
            $tab[0]["id"],
        );
        return $theChosenOne;
    }

    public static function getAll()
    {
        $request = DB::connect()->prepare("select * from exploration");
        $request->execute();
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach($tab as $row)
        {
            $tabObjectsTwo[] = new Exploration
            (
                $row["id"],
            );
        }
        return $tabObjectsTwo;
    }
    public static function getID(){
        $Connection = DB::connect();
        $getIdRobot = $Connection->prepare("SELECT id_robot FROM robot");
        $getIdExploration = $Connection->prepare("SELECT id_exploration FROM exploration");
    }
}