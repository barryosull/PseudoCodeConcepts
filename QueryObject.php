<?php

interface iQueryAbleService
{
    /** @return iQueryResult */
    public function query(iQuery $query);
}

interface iQuery 
{

}

interface iJobSeekerQuery extends iQueryAbleService 
{
    /** @return iJobseekerQueryResult */
    public function query(iQuery $query);
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
    
    /** @return integer */
    public function count();
}

interface iJobseekerQueryResult extends iQueryResult
{
    /** @return JobSeekerViewEntry[] */
    public function get_all();
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

}

class JobSeekerViewEntry implements iViewEntry
{
    public $name;
    public $age;
}

class ResultSetIterator
{
    public function interate(iJobseekerQueryResult $set)
    {
        $set = $set->sort_by('field', 'desc')
            ->limit_result_set(10, 20);
        $rows = $set->get_all();
        foreach($rows as $row) {
            ;
        }
    }
}

/** TODO: 
 * Figure out some way that we can return the result object as a PDO, in some way that the IDE can understand it
 * It's proving tricky
 */

