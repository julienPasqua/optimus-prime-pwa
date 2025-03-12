<?php
class Robot_exploration{
    private $id;
    private $id2;
    
    public function __construct($id, $id2){
        $this->id = $id;
        $this->id2 = $id2;
    }

    public static function getOne($id,$id2){
        $request = DB::connect()->prepare("select * from robot where id = ?");
        $request->execute([$id]);
        $request2= DB::connect()->prepare("select * from exploration where id = ?");
        $request2->execute([$id2]);
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        $tab2 = $request2->fetchAll(PDO::FETCH_ASSOC);
        $theChosenOne = new Robot
        (
            $tab[0]["id"],
            $tab[0]["name"],
        );
        $theChosenTwo = new Exploration
        (
            $tab2[0]["id2"],
        );
        return ['robots' => $theChosenOne, 'explorations' => $theChosenTwo];
    }

    public static function getAll()
    {
        $request = DB::connect()->prepare("select * from robot");
        $request->execute();
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach($tab as $row)
        {
            $tabObjectsOne[] = new Robot
            (
                $row["id"],
                $row["name"]
            );
        }
        $request2 = DB::connect()->prepare("select * from exploration");
        $request2->execute();
        $tab2 = $request2->fetchAll(PDO::FETCH_ASSOC);
        foreach($tab2 as $row2)
        {
            $tabObjectsTwo[] = new Exploration
            (
                $row2["id"],
            );
        }
        return ['robots' => $tabObjectsOne, 'explorations' => $tabObjectsTwo];
    }
}