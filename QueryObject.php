<?php

interface iQueryAbleService
{
    /** @return iQueryResult */
    public function query(iQuery $query);
}

interface iQuery 
{


}

interface iQueryResult
{
    /**
     * @param type $start_index
     * @param type $end_index
     * @return iQueryResult
     */
    public function limit_result_set($start_index, $end_index);
    
     /**
     * @param type $field
     * @param type $order
     * @return iQueryResult
     */
    public function sort_by($field, $order);

    /** @return iViewEntry[]*/
    public function get_all();
    
    /** @return integer */
    public function count();
}

class EloquentResultSet implements iQueryResult{
    
    public function count() {
        return 1;
    }

    
    public function get_all() {
        return [ new stdClass(), new stdClass()];
    }

    public function limit_result_set($start_index, $end_index) {
        return $this;
    }

    public function sort_by($field, $order) {
        return $this;
    }
}

interface iViewEntry
{
    public function field_count();
}

class JobseekerViewEntry implements iViewEntry
{
    public $name;
    public $age;
    
    public function field_count()
    {
        return 2;
    }
}

class ResultSetIterator
{
    public function interate()
    {
        $full_set = new EloquentResultSet();
        
        $set = $full_set->sort_by('field', 'desc')
            ->limit_result_set(10, 20);
        
        $rows = $set->get_all();
        
        foreach($rows as $row) {
            echo $row->field_count();
        }
    }
}

