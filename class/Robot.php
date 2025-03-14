<?php
class Robot{
    private $id; 
    private $name;
    
    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
    public static function getOne($id)
    {
        $request = DB::connect()->prepare("select * from robot where id = ?");
        $request->execute([$id]);
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        $theChosenOne = new Robot
        (
            $tab[0]["id"],
            $tab[0]["name"]
        );
        return $theChosenOne;
    }

    public static function getAll()
    {
        $request = DB::connect()->prepare("select * from robot");
        $request->execute();
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach($tab as $row)
        {
            $tabObjects[] = new Robot
            (
                $row["id"],
                $row["name"]
            );
        }
        return $tabObjects;
    }
}