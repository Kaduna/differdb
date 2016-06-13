<?php
namespace App\Services;

use App\Models\Connection;
use App\Services\BaseService;
use App\Models\Deploy;
use App\Models\Change;

use Illuminate\Support\Facades\DB;

use Connect;

/**
 * Class SyncService
 * @package App\Services
 */
class SyncService extends BaseService
{
    /**
     * Create a SQL statement of all changes provided in $changes_list
     * @param array $changes_list
     * @return string with all the SQL-queries
     */
    public function generateSql(array $changes_list) {
        // Get all sql
        $changes = Change::whereIn('id', $changes_list)->orderBy('sort', 'asc')->get();


        // Add a custom header
        $sql = '
            /* MySQL Script generated by DifferDB */
        ';

        $sql .= "\n";

        // Loop the changes and append them
        foreach($changes as $change) {
            $sql .= $change->sql;
            if($change->entity == 'index') {
                foreach($change->children()->get() as $child) {
                    $sql .= $child->sql;
                }
            }
        }

        return $sql;
    }

    /**
     * Execute SQL queries at the given connection and additional databases
     * @param $sql
     * @param Connection $connection
     * @param $databases
     * @return array with results per database
     */
    public function executeMysql($sql, Connection $connection, $databases) {
        // Add the main database to the databases array
        array_unshift($databases, $connection->database_name);

        // Create an array with the results of the synchronisation per database
        $results = [];

        foreach($databases as $database_name) {
            $connection_array = [
                'host' => $connection->host,
                'username' => $connection->username,
                'password' => $connection->password,
                'database_name' => $database_name
            ];
            // Connect to the database
            $connect = Connect::connect('db_two', $connection_array);

            // If the connection succeeded
            if($connect === true) {
                // Run the SQL (unprepared)
                try {
                    DB::unprepared($sql);
                    $results[$database_name]['success'] = true;
                    $results[$database_name]['message'] = 'Synchronization successful!';
                } catch(\Exception $e) {
                    $results[$database_name]['success'] = false;
                    $results[$database_name]['message'] = $e->getMessage();
                }
            } else {
                $results[$database_name]['success'] = false;
                $results[$database_name]['message'] = $connect;
            }
        }

        return $results;

    }
}