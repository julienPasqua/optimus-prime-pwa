<?php
class Event
{

    private $id;
    private $type_id;
    private $exploration_id;

    public function __construct($id, $type_id, $exploration_id){
        $this->id = $id;
        $this->type_id = $type_id;
        $this->exploration_id = $exploration_id;
    }

    public function getOne($id){
        $request = DB::connect()->prepare("select * from event where id = ?");
        $request->execute([$id]);
        $tab = $request->fetch(PDO::FETCH_ASSOC);
        $theChosenOne = new Event
        (
            $tab["id"],
            $tab["type_id"],
            $tab["exploration_id"]
        );
        return $theChosenOne;
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

    public function getType_id()
    {
        return $this->type_id;
    }

    public function setType_id($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getExploration_id()
    {
        return $this->exploration_id;
    }

    public function setExploration_id($exploration_id)
    {
        $this->exploration_id = $exploration_id;

        return $this;
    }
}