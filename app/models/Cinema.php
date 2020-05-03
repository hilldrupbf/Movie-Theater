<?php
    class Cinema {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getManagerIdByCinemaId($cinema_id) {
            // Calls query function from Database class in 'libraries' folder
            $this->db->query('SELECT manager_id FROM cinema WHERE cinema_id = :id');
            // Calls bind function from Database class in 'libraries' folder
            $this->db->bind(':id', $cinema_id);

            // Calls single function from Database class in 'libraries' folder
            $row = $this->db->single();
            $row = json_decode(json_encode($row), true);

            // Checks row to see if the row exists
            if($row) {
                // Manger found
                return $row['manager_id'];
            }
            else {
                // Email not found
                return null;
            }
        }

        public function getManagerNameById($id) {
            $this->db->query('SELECT managerNameById(:id) as manager_name FROM dual');
            $this->db->bind(':id', $id);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['manager_name'];
        }

        public function getManagerEmailById($id) {
            $this->db->query('SELECT managerEmailById(:id) as manager_email FROM dual');
            $this->db->bind(':id', $id);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['manager_email'];
        }

        public function getManagerPhoneById($id) {
            $this->db->query('SELECT managerPhoneById(:id) as manager_phone FROM dual');
            $this->db->bind(':id', $id);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['manager_phone'];
        }

        public function getManagerAddressById($id) {
            $this->db->query('SELECT managerAddressById(:id) as manager_address FROM dual');
            $this->db->bind(':id', $id);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['manager_address'];
        }


        // Daily Queries
        public function getTotalDailyTickets($cinema_id, $date) {
            $this->db->query('SELECT dailyTickets(:cinema_id, :date) as total_tickets FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['total_tickets'];
        }

        public function getDailyGrossSales($cinema_id, $date) {
            $this->db->query('SELECT dailyGrossSales(:cinema_id, :date) as gross_sales FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['gross_sales'];
        }

        public function getDailySalesByType($cinema_id, $date, $type) {
            $this->db->query('SELECT dailySalesByType(:cinema_id, :date, :type) as type_sales FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $this->db->bind(':type', $type);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['type_sales'];
        }

        public function getDailyTransactions($cinema_id, $date) {
            $this->db->query('SELECT dailyTransactions(:cinema_id, :date) as num_transactions FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['num_transactions'];
        }

        // Monthly Queries
        public function getTotalMonthlyTickets($cinema_id, $date) {
            $this->db->query('SELECT monthlyTickets(:cinema_id, :date) as total_tickets FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['total_tickets'];
        }

        public function getMonthlyGrossSales($cinema_id, $date) {
            $this->db->query('SELECT monthlyGrossSales(:cinema_id, :date) as gross_sales FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['gross_sales'];
        }

        public function getMonthlySalesByType($cinema_id, $date, $type) {
            $this->db->query('SELECT monthlySalesByType(:cinema_id, :date, :type) as type_sales FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $this->db->bind(':type', $type);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['type_sales'];
        }

        public function getMonthlyTransactions($cinema_id, $date) {
            $this->db->query('SELECT monthlyTransactions(:cinema_id, :date) as num_transactions FROM dual');
            $this->db->bind(':cinema_id', $cinema_id);
            $this->db->bind(':date', $date);
            $result = json_decode(json_encode($this->db->single()), true);
            return $result['num_transactions'];
        }


        // PAULS QUERIES
        // A function to get the employees from the store id
        public function getEmployees($store_id){
            //make query
            $this->db->query( 'SELECT * FROM employee WHERE store_number =:store_id ');
            //bind the values
            $this->db->bind(':store_id',$store_id);
            //execute the query
            $results = $this->db->resultSet();
            //return the result
            return $results;
    
        }
        public function addEmployees($data){
            //query
            $this->db->query( 'INSERT INTO `employee` 
            (`employee_id`, `first_name`, `last_name`,`email`, `phone`, `birthdate`, `salary`, `hire_date`, `ssn`, `store_number`, `manager_id`) 
                 VALUES(NULL,:first_name,:last_name,:email, :phone, :birthdate, :salary, :hire_date, :ssn, :store_number, :manager_id )');
            //bind the values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':birthdate', $data['birthdate']);
            $this->db->bind(':salary', $data['salary']);
            $this->db->bind(':hire_date', $data['hire_date']);
            $this->db->bind(':ssn', $data['ssn']);
            //$this->db->bind(':address_id', $data['adress_id']);
            $this->db->bind(':store_number', $data['store_number']);
            $this->db->bind(':manager_id', $data['manager_id']);
            //execute
            $this->db->execute();
        }

        public function updateEmployee($data){

            $this->db->query('UPDATE employee SET `first_name` = :first_name, `last_name`=:last_name,`email`=:email, `phone`=:phone, `birthdate`=:birthdate, `salary`=:salary, `hire_date`=:hire_date, `ssn`=:ssn, `store_number`=:store_number, `manager_id`=:manager_id  
            WHERE `employee_id` =:employee_id');
             //bind the values
             $this->db->bind(':first_name', $data['first_name']);
             $this->db->bind(':last_name', $data['last_name']);
             $this->db->bind(':email', $data['email']);
             $this->db->bind(':phone', $data['phone']);
             $this->db->bind(':birthdate', $data['birthdate']);
             $this->db->bind(':salary', $data['salary']);
             $this->db->bind(':hire_date', $data['hire_date']);
             $this->db->bind(':ssn', $data['ssn']);
             $this->db->bind(':employee_id', $data['employee_id']);
             $this->db->bind(':store_number', $data['store_number']);
             $this->db->bind(':manager_id', $data['manager_id']);
             //execute
             $this->db->execute();
        }
    }