<?php
class Event{
    private $id;
    private $type_id;
    private $exploration_id;
    public function getOne($id,$type_id,$exploration_id){
        $request = DB::connect()->prepare("select * from event where id = ?");
        $request->execute([$id]);
        $request2= DB::connect()->prepare("select * from type where id = ?");
        $request2->execute([$type_id]);
        $request3= DB::connect()->prepare("select * from exploration where id = ?");
        $request3->execute([$exploration_id]);
        $tab = $request->fetchAll(PDO::FETCH_ASSOC);
        $tab2 = $request2->fetchAll(PDO::FETCH_ASSOC);
        $tab3 = $request3->fetchAll(PDO::FETCH_ASSOC);
        $theChosenOne = new Event
        (
            $tab[0]["id"],
            $tab2[0]["type_id"],
            $tab3[0]["exploration_id"]
        );
        return $theChosenOne;
    }

    public function __construct($id, $type_id, $exploration_id){
        $this->id = $id;
        $this->type_id = $type_id;
        $this->exploration_id = $exploration_id;
    }
}