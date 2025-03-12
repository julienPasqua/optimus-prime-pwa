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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getExploration_date()
    {
        return $this->exploration_date;
    }

    public function setExploration_date($exploration_date)
    {
        $this->exploration_date = $exploration_date;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }
}