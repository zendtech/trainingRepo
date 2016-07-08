<?php
/**
 * Customers Db Table Class
 */
class CustomersModel extends AbstractModel
{
    //Map the properties to the table columns
    protected $id = 'id';
    protected $firstname = 'firstname';
    protected $lastname = 'lastname';

    /**
     * @param int $id
     * @return bool
     */
    public function getCustomer(int $id)
    {
        //Initialize a statement
        $stmt = null;

        // Build a query
        $query = "SELECT * FROM customers WHERE id = $id";

        try{
            if ($stmt = $this->pdo->query($query)) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new ModelException('Query error: No customer returned');
            }
        } catch (ModelException $e) {
            //Append the error to the defined log
            error_log($e->getMessage(), 3, 'error.log');
        }

        //On failure ...
        return false;
    }

    /**
     * @return array|bool
     */
    public function getCustomers()
    {
        //Initialize a statement
        $stmt = null;

        // Build a query
        $query = "SELECT id, CONCAT($this->lastname,', ', $this->firstname) AS customer_name FROM customers ORDER BY $this->lastname";

        try {
            if ($stmt = $this->pdo->query($query)) {

                // Provide empty array to hold the results
                $customers = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Fetch row content
                    $customers[] = $row; // Populate the customers array
                }
                if (!empty($customers)) {
                    return $customers;
                }

                //If we haven't returned anything by now, return false
                return false;
            } else {
                throw new ModelException('Query error');
            }
        } catch (ModelException $e) {
            //Append the error to the defined log
            error_log($e->getMessage(), 3, 'error.log');
        }
    }
}