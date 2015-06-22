<?php
/**
 *
 * Course model
 *
 * @copyright       2014 © Moore8. ALL Rights Reserved
 * @author          Moore8 Team
 */
class Article_baseinfo_model extends MY_CORE_Model
{
    public $table = 'article_baseinfo';

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
    public function get_articles($select='', $where = array(), $limit = false, $offset = false, $by = false, $sort = 'desc')
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

    /**
     * Get course count
     *
     * @param string $title
     * @param string $owner
     * @param array $where
     * @return array
     */
    public function get_course_count($where = array(), $title = false, $owner = false)
    {
        if ($title) {
            $this->db->like('title', $title);
        }
        $this->db->from($this->table);

        if ($owner) {
            $this->db->join('member', "member.user_id = {$this->table}.owner_id", 'left');
            $this->db->like('nick_name', $owner);
        }

        if (!empty($where)) {
            $this->db->where($where);
        }

        return $this->db->count_all_results();
    }

    /**
     * Lists
     *
     * @param int $limit
     * @param int $offset
     * @param string $title
     * @param string $owner
     * @param array $where
     * @param array $by
     * @return array
     */
    public function lists($limit = '', $offset = 0, $title = false, $owner = false, $where = array(), $by = 'created_at')
    {
        $this->db->select("{$this->table}.id,draft_version_id,title,created_at,published_time,category_id,num_subscribers,verify_status,nick_name as owner");
        $this->db->from($this->table);
        $this->db->join('member', "member.user_id = {$this->table}.owner_id", 'left');

        if (!empty($where)) {
            $this->db->where($where);
        }

        if ($title) {
            $this->db->like('title', $title);
        }

        if ($owner) {
            $this->db->like('nick_name', $owner);
        }

        if (!empty($by)) {
            $this->db->order_by($by, 'desc');
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get()->result_array();

        return $query;
    }

    /**
     * List with user
     *
     * @param array $ids
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function list_with_user($ids, $limit = '', $offset = 0)
    {
        $this->db->select("{$this->table}.id,title,created_at,category_id,nick_name as owner");
        $this->db->from($this->table);
        $this->db->join('member', "member.user_id = {$this->table}.owner_id", 'left');

        if (!empty($ids)) {
            $this->db->where_in("{$this->table}.id", $ids);
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get()->result_array();

        return $query;
    }

    /**
     * Save
     *
     * @param array $data
     * @return void
     */
    public function save($data)
    {
        if (isset($data['id'])) {
            if (empty($data['updated_at'])) {
                $data['updated_at'] = time();
            }
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
        } else {
            if (empty($data['created_at'])) {
                $data['created_at'] = time();
            }
            if (empty($data['updated_at'])) {
                $data['updated_at'] = time();
            }
            $this->db->insert($this->table, $data);

            return $this->db->insert_id();
        }
    }

    /**
     * Get courses info
     *
     * @param array $ids
     * @param array $where
     * @return array
     */
    public function get_courses_info($ids = array(), $where = array())
    {
        if (!is_array($ids)) {
            $ids = array($ids);
        }

        $this->db->where_in('id', $ids);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($this->table);
        $result = $this->db->get()->result_array();
        $return = array();
        foreach ($ids as &$id) {
            foreach ($result as $value) {
                if ($id==$value['id']) {
                    $return[] = $value;
                    break;
                }
            }
        }

        return $return;
    }

    /**
     * Ids
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function ids($limit = '',$offset = 0)
    {
        $this->db->from($this->table);
        $this->db->select('id');
        if ($limit) {
            $this->db->limit($limit,$offset);
        }
        $result = $this->db->get()->result_array();
        $return = array();
        foreach ($result as $r) {
            $return[] = $r['id'];
        }

        return $return;
    }

    /**
     * Suggest course
     *
     * @param string $title
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function suggest_course($title, $where = array(), $limit = 1, $offset = 0)
    {
        $this->db->from($this->table);
        if ($title) {
            $this->db->like('title', $title, 'after');
        }

        if (!empty($where)) {
            $this->db->where($where);
        }

        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }

        return $this->db->get()->result_array();
    }

    /**
     * Check verify
     *
     * @param array $where
     * @return array
     */
    public function check_verify($where)
    {
        $this->db->select("id");
        $this->db->from($this->table);
        if (!empty($where)) {
            $this->db->where($where);
        }

        $result = $this->db->get()->result_array();
        $tmp = array();
        foreach ($result as $value) {
            $k = $value['id'];
            $tmp[$k] = $value;
        }
        $result = $tmp;

        return $result;
    }

    /**
     * Get relate course list
     *
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param string $by
     * @param string $sort
     * @return array
     */
    public function get_relate_course_list($where = array(), $where_not_in = array(), $limit = false, $offset = false, $by = false, $sort = false)
    {
        if (!empty($where_not_in)) {
            $this->db->where_not_in('id', $where_not_in);
        }

        return parent::get_list($where, $limit, $offset, $by, $sort);
    }

    /**
     * List with ids
     *
     * @param array $ids
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function list_with_ids($ids, $where = '', $limit = '', $offset = 0)
    {
        $this->db->from($this->table);

        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($ids)) {
            $this->db->where_in("id", $ids);
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get()->result_array();

        return $query;
    }

    /**
     * List with user
     *
     * @param array $ids
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_courses_by_student_count($where, $limit = '', $offset = 0,  $order = false, $sort = 'desc', $group_by = array())
    {
        $this->db->select("{$this->table}.*");
        $this->db->from($this->table);
        $this->db->join('student', "student.course_id = {$this->table}.id", 'left');

        $this->db->where($where);

        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($order) {
            $this->db->order_by($order, $sort);
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }

        $query = $this->db->get()->result_array();
        return $query;
    }

    /**
     * Get Lists for sort and limit
     *
     * @param array $in_array
     * @param array $where
     * @param string $key
     */
    public function get_list_in_forsort($in_array, $key = 'id', $where = array(),$limit = false, $offset = false, $by = false, $sort = 'desc')
    {
        $this->db->from($this->table);
        $this->db->where_in($key, $in_array);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($by)) {
            $sort = ('asc' === strtolower(trim($sort))) ? 'asc' : 'desc';
            $this->db->order_by($by, $sort);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($offset) {
            $this->db->offset($offset);
        }
        $result = $this->db->get()->result_array();

        return $result;
    }

    /**
     * Get course by tags
     *
     * @param array $array_results_by_sql
     * @param array $array
     */
    public function get_courses_by_tags($array_results_by_sql, $array_one )
    {
        $this->load->library('course_lib');
        foreach ($array_results_by_sql as &$array_one) {
            if($array_one['course_id'] == null)
               $id                =  $array_one['id'];
           else
               $id                =  $array_one['course_id'];
               $array_one         =  $this->course_lib->format_course($id, 'front');
               $courses           =  $this->get_one(array('id' => $id));
               $courses['description']       =  htmlspecialchars_decode($courses['description']);
               $course_gets[]     = array(
                    'title'         =>   $courses['title'],
                    'image_url'     =>   $array_one['images']['img_480x270'],
                    'description'   =>   strip_tags($courses['description']),
                    'course_id'     =>   $id,
                    'course_url'    =>   site_url('courses/' . $id)
                                    );
            }

        return $course_gets;
    }

}
