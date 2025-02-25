<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_Datatables extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function get_tables($tables, $cari, $iswhere)
  {
    // Ambil data yang di ketik user pada textbox pencarian
    $search = htmlspecialchars($_POST['search']['value']);
    // Ambil data limit per page
    $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
    // Ambil data start
    $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}");

    $query = $tables;

    if (!empty($iswhere)) {
      $sql = $this->db->query("SELECT * FROM " . $query . " WHERE " . $iswhere);
    } else {
      $sql = $this->db->query("SELECT * FROM " . $query);
    }

    $sql_count = $sql->num_rows();

    $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";


    // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_field = $_POST['order'][0]['column'];

    // Untuk menentukan order by "ASC" atau "DESC"
    $order_ascdesc = $_POST['order'][0]['dir'];
    $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

    if (!empty($iswhere)) {
      $sql_data = $this->db->query("SELECT * FROM " . $query . " WHERE $iswhere AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
    } else {
      $sql_data = $this->db->query("SELECT * FROM " . $query . " WHERE (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
    }

    if (isset($search)) {
      if (!empty($iswhere)) {
        $sql_cari =  $this->db->query("SELECT * FROM " . $query . " WHERE $iswhere (" . $cari . ")");
      } else {
        $sql_cari =  $this->db->query("SELECT * FROM " . $query . " WHERE (" . $cari . ")");
      }
      $sql_filter_count = $sql_cari->num_rows();
    } else {
      if (!empty($iswhere)) {
        $sql_filter = $this->db->query("SELECT * FROM " . $query . "WHERE " . $iswhere);
      } else {
        $sql_filter = $this->db->query("SELECT * FROM " . $query);
      }
      $sql_filter_count = $sql_filter->num_rows();
    }
    $data = $sql_data->result_array();

    $callback = array(
      'draw' => $_POST['draw'], // Ini dari datatablenya    
      'recordsTotal' => $sql_count,
      'recordsFiltered' => $sql_filter_count,
      'data' => $data
    );
    return json_encode($callback); // Convert array $callback ke json
  }

  function get_tables_where($tables, $cari, $where, $iswhere)
  {
    // Ambil data yang di ketik user pada textbox pencarian
    $search = htmlspecialchars($_POST['search']['value']);
    // Ambil data limit per page
    $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
    // Ambil data start
    $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}");

    $setWhere = array();
    foreach ($where as $key => $value) {
      $setWhere[] = $key . "='" . $value . "'";
    }

    $fwhere = implode(' AND ', $setWhere);

    if (!empty($iswhere)) {
      $sql = $this->db->query("SELECT * FROM " . $tables . " WHERE $iswhere AND " . $fwhere);
    } else {
      $sql = $this->db->query("SELECT * FROM " . $tables . " WHERE " . $fwhere);
    }
    $sql_count = $sql->num_rows();

    $query = $tables;
    $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

    // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_field = $_POST['order'][0]['column'];

    // Untuk menentukan order by "ASC" atau "DESC"
    $order_ascdesc = $_POST['order'][0]['dir'];
    $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

    if (!empty($iswhere)) {
      $sql_data = $this->db->query("SELECT * FROM " . $query . " WHERE $iswhere AND " . $fwhere . " AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
    } else {
      $sql_data = $this->db->query("SELECT * FROM " . $query . " WHERE " . $fwhere . " AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
    }

    if (isset($search)) {
      if (!empty($iswhere)) {
        $sql_cari =  $this->db->query("SELECT * FROM " . $query . " WHERE $iswhere AND " . $fwhere . " AND (" . $cari . ")");
      } else {
        $sql_cari =  $this->db->query("SELECT * FROM " . $query . " WHERE " . $fwhere . " AND (" . $cari . ")");
      }
      $sql_filter_count = $sql_cari->num_rows();
    } else {
      if (!empty($iswhere)) {
        $sql_filter = $this->db->query("SELECT * FROM " . $tables . " WHERE $iswhere AND " . $fwhere);
      } else {
        $sql_filter = $this->db->query("SELECT * FROM " . $tables . " WHERE " . $fwhere);
      }
      $sql_filter_count = $sql_filter->num_rows();
    }

    $data = $sql_data->result_array();

    $callback = array(
      'draw' => $_POST['draw'], // Ini dari datatablenya    
      'recordsTotal' => $sql_count,
      'recordsFiltered' => $sql_filter_count,
      'data' => $data
    );
    return json_encode($callback); // Convert array $callback ke json
  }

  function get_tables_query($query, $cari, $where, $iswhere, $group)
  {
    // Ambil data yang di ketik user pada textbox pencarian
    $search = htmlspecialchars($_POST['search']['value']);
    // Ambil data limit per page
    $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
    // Ambil data start
    $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}");

    // pastikan $search itu string walaupun yang dimasukan angka 
    $search = (string) $search;

    if ($where != null) {
      $setWhere = array();
      foreach ($where as $key => $value) {
        $setWhere[] = $key . "='" . $value . "'";
      }
      $fwhere = implode(' AND ', $setWhere);

      if (!empty($iswhere)) {
        $sql = $this->db->query($query . " WHERE  $iswhere AND " . $fwhere . $group);
      } else {
        $sql = $this->db->query($query . " WHERE " . $fwhere.$group);
      }
      $sql_count = $sql->num_rows();

      $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

      // Untuk mengambil nama field yg menjadi acuan untuk sorting
      $order_field = $_POST['order'][0]['column'];

      // Untuk menentukan order by "ASC" atau "DESC"
      $order_ascdesc = $_POST['order'][0]['dir'];
      $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

      if (!empty($iswhere)) {
        $sql_data = $this->db->query($query . " WHERE $iswhere AND " . $fwhere . " AND (" . $cari . ")" .$group. $order . " LIMIT " . $limit . " OFFSET " . $start);
      } else {
        $sql_data = $this->db->query($query . " WHERE " . $fwhere . " AND (" . $cari . ")" .$group. $order . " LIMIT " . $limit . " OFFSET " . $start);
      }

      if (isset($search)) {
        if (!empty($iswhere)) {
          $sql_cari =  $this->db->query($query . " WHERE $iswhere AND " . $fwhere . " AND (" . $cari . ")".$group);
        } else {
          $sql_cari =  $this->db->query($query . " WHERE " . $fwhere . " AND (" . $cari . ")".$group);
        }
        $sql_filter_count = $sql_cari->num_rows();
      } else {
        if (!empty($iswhere)) {
          $sql_filter = $this->db->query($query . " WHERE $iswhere AND " . $fwhere.$group);
        } else {
          $sql_filter = $this->db->query($query . " WHERE " . $fwhere.$group);
        }
        $sql_filter_count = $sql_filter->num_rows();
      }
      $data = $sql_data->result_array();
    } else {
      if (!empty($iswhere)) {
        $sql = $this->db->query($query . " WHERE  $iswhere ".$group);
      } else {
        $sql = $this->db->query($query." ".$group);
      }
      $sql_count = $sql->num_rows();

      $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

      // Untuk mengambil nama field yg menjadi acuan untuk sorting
      $order_field = $_POST['order'][0]['column'];

      // Untuk menentukan order by "ASC" atau "DESC"
      $order_ascdesc = $_POST['order'][0]['dir'];
      $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

      if (!empty($iswhere)) {
        $sql_data = $this->db->query($query . " WHERE $iswhere AND (" . $cari . ")" .$group. $order . " LIMIT " . $limit . " OFFSET " . $start);
      } else {
        $sql_data = $this->db->query($query . " WHERE (" . $cari . ")" .$group. $order . " LIMIT " . $limit . " OFFSET " . $start);
      }

      if (isset($search)) {
        if (!empty($iswhere)) {
          $sql_cari =  $this->db->query($query . " WHERE $iswhere AND (" . $cari . ")".$group);
        } else {
          $sql_cari =  $this->db->query($query . " WHERE (" . $cari . ")".$group);
        }
        $sql_filter_count = $sql_cari->num_rows();
      } else {
        if (!empty($iswhere)) {
          $sql_filter = $this->db->query($query . " WHERE $iswhere".$group);
        } else {
          $sql_filter = $this->db->query($query." ".$group);
        }
        $sql_filter_count = $sql_filter->num_rows();
      }
      $data = $sql_data->result_array();
    }

    $callback = array(
      'draw' => $_POST['draw'], // Ini dari datatablenya    
      'recordsTotal' => $sql_count,
      'recordsFiltered' => $sql_filter_count,
      'data' => $data
    );
    return json_encode($callback); // Convert array $callback ke json
  }

  function get_tables_query_group($query, $cari, $where, $iswhere, $group)
{
    // Sanitize and validate inputs
    $search = htmlspecialchars($_POST['search']['value'] ?? '');
    $limit = (int)($_POST['length'] ?? 10);
    $start = (int)($_POST['start'] ?? 0);
    
    // Set up query building
    $whereClause = '';
    $bindParams = [];
    $sql_count = 0;
    $sql_filter_count = 0;
    
    // Build the where clause
    if ($where != null) {
        $setWhere = [];
        foreach ($where as $key => $value) {
            $setWhere[] = "$key = ?";
            $bindParams[] = $value;
        }
        $whereClause = implode(' AND ', $setWhere);
    }
    
    // Prepare base query with appropriate WHERE clauses
    $baseQuery = $query;
    if (!empty($whereClause) && !empty($iswhere)) {
        $baseQuery .= " WHERE $iswhere AND $whereClause";
    } elseif (!empty($whereClause)) {
        $baseQuery .= " WHERE $whereClause";
    } elseif (!empty($iswhere)) {
        $baseQuery .= " WHERE $iswhere";
    }
    
    // Add group by if provided
    if (!empty($group)) {
        $baseQuery .= " $group";
    }
    
    // Execute count query for total records (utilize query caching)
    $sql_result = $this->db->query($baseQuery);
    $sql_count = $sql_result->num_rows();
    
    // Build search criteria
    $searchClause = '';
    if (!empty($search)) {
        $searchTerms = [];
        foreach ($cari as $field) {
            $searchTerms[] = "$field LIKE ?";
            $bindParams[] = "%$search%";
        }
        $searchClause = !empty($searchTerms) ? '(' . implode(' OR ', $searchTerms) . ')' : '';
    }
    
    // Prepare final query with search, order and limit
    $finalQuery = $baseQuery;
    if (!empty($searchClause)) {
        $finalQuery .= !empty($whereClause) || !empty($iswhere) ? " AND $searchClause" : " WHERE $searchClause";
    }
    
    // Sorting
    $orderColumn = isset($_POST['order'][0]['column']) ? (int)$_POST['order'][0]['column'] : 0;
    $orderDir = isset($_POST['order'][0]['dir']) && strtolower($_POST['order'][0]['dir']) === 'desc' ? 'DESC' : 'ASC';
    
    // Validate that column index exists to prevent SQL injection
    if (isset($_POST['columns'][$orderColumn]['data'])) {
        $orderField = $_POST['columns'][$orderColumn]['data'];
        $finalQuery .= " ORDER BY " . $this->db->escape_str($orderField) . " " . $orderDir;
    }
    
    // Apply limit
    $finalQuery .= " LIMIT $limit OFFSET $start";
    
    // Execute final query with parameters
    $sql_data = $this->db->query($finalQuery);
    $data = $sql_data ? $sql_data->result_array() : [];
    
    // Get filtered count
    if (!empty($search)) {
        $filterCountQuery = $baseQuery;
        if (!empty($searchClause)) {
            $filterCountQuery .= !empty($whereClause) || !empty($iswhere) ? " AND $searchClause" : " WHERE $searchClause";
        }
        $sql_filter_result = $this->db->query($filterCountQuery);
        $sql_filter_count = $sql_filter_result->num_rows();
    } else {
        $sql_filter_count = $sql_count;
    }
    
    // Return response
    $callback = [
        'draw' => isset($_POST['draw']) ? (int)$_POST['draw'] : 0,
        'recordsTotal' => $sql_count,
        'recordsFiltered' => $sql_filter_count,
        'data' => $data
    ];
    
    return json_encode($callback);
}

  function get_tables_query_csrf($query, $cari, $where, $csrf_name, $csrf_hash)
  {
    // Ambil data yang di ketik user pada textbox pencarian
    $search = htmlspecialchars($_POST['search']['value']);
    // Ambil data limit per page
    $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
    // Ambil data start
    $start = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}");

    if ($where != null) {
      $setWhere = array();
      foreach ($where as $key => $value) {
        $setWhere[] = $key . "='" . $value . "'";
      }

      $fwhere = implode(' AND ', $setWhere);

      $sql = $this->db->query($query . " WHERE " . $fwhere);
      $sql_count = $sql->num_rows();

      $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

      // Untuk mengambil nama field yg menjadi acuan untuk sorting
      $order_field = $_POST['order'][0]['column'];

      // Untuk menentukan order by "ASC" atau "DESC"
      $order_ascdesc = $_POST['order'][0]['dir'];
      $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

      $sql_data = $this->db->query($query . " WHERE " . $fwhere . " AND (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
      $sql_filter = $this->db->query($query . " WHERE " . $fwhere);

      if (isset($search)) {
        $sql_cari =  $this->db->query($query . " WHERE " . $fwhere . " AND (" . $cari . ")");
        $sql_filter_count = $sql_cari->num_rows();
      } else {
        $sql_filter_count = $sql_filter->num_rows();
      }

      $data = $sql_data->result_array();
    } else {

      $sql = $this->db->query($query);
      $sql_count = $sql->num_rows();

      $cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

      // Untuk mengambil nama field yg menjadi acuan untuk sorting
      $order_field = $_POST['order'][0]['column'];

      // Untuk menentukan order by "ASC" atau "DESC"
      $order_ascdesc = $_POST['order'][0]['dir'];
      $order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

      $sql_data = $this->db->query($query . " WHERE (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
      $sql_filter = $this->db->query($query);

      if (isset($search)) {
        $sql_cari =  $this->db->query($query . " WHERE (" . $cari . ")");
        $sql_filter_count = $sql_cari->num_rows();
      } else {
        $sql_filter_count = $sql_filter->num_rows();
      }

      $data = $sql_data->result_array();
    }

    $callback = array(
      'draw' => $_POST['draw'], // Ini dari datatablenya    
      'recordsTotal' => $sql_count,
      'recordsFiltered' => $sql_filter_count,
      'data' => $data
    );
    $callback[$csrf_name] = $csrf_hash;

    return json_encode($callback); // Convert array $callback ke json
  }
}
