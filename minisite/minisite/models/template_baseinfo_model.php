<?php

Class Template_baseinfo_model extends MY_Core_Model {
	//public table="template_baseinfo";
	public $table="template_baseinfo";
	 /**
     * Delete
     *
     * @param array $where
     * @return void
     */
    public function delete($where)
    {
        if (is_numeric($where)) {
            $where = array('id' => $where);
        }
        $this->db->where($where);
        $this->db->update($this->table, array(
            'is_deleted' => 1
        ));
    }
    /**
     * Get courses
     *
     * @param array $select
     * @param array or int $where_or_id
     * @return array
     */
    public function get_templates($select='', $where = array(), $limit = false, $offset = false, $by = false, $sort = 'desc')
    {
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        if (!empty($by)) {
            $sort = ('asc' === strtolower(trim($sort))) ? 'asc' : 'desc';
            $this->db->order_by($by, $sort);
        }
        $result = $this->db->get($this->table)->result_array();

        return $result;
    }
}