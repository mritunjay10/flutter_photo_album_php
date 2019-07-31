<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 6/4/19
 * Time: 6:11 PM
 */

class Queries
{
    public function getAll($tableName, $order = "ASC"){

        return "SELECT * FROM `$tableName` WHERE `status` = 'active' ORDER BY `id` $order ";
    }

    public function where($tableName, $column, $value){

        return "SELECT * FROM `$tableName` WHERE `$column` = '$value' AND `status` = 'active' ";
    }

    public function insert($tableName, $reqArray){

        $columns = implode(", ",array_keys($reqArray));
        $values = implode(", ",array_values($reqArray));

        return "INSERT INTO `$tableName`  ($columns) VALUES ($values)";
    }

    public function update($tableName, $reqArray, $id){

        $cols = array();

        foreach($reqArray as $key=>$val) {
            $cols[] = "$key = '$val'";
        }
        $sql = "UPDATE $tableName SET " . implode(', ', $cols) . " WHERE `id`=$id";

        return ($sql);

    }

    public function delete($tableName, $id){


        return "UPDATE `$tableName` SET `status`='deleted' WHERE `id` = '$id'";

    }

    public function getAlbums(){

        return "SELECT `albums`.`id`, `albums`.`album_name`, `albums`.`album_cover`, `albums`.`user_id`, `users`.`user_name` FROM `albums` INNER JOIN `users` ON `albums`.`user_id` = `users`.`id` WHERE `albums`.`status` = 'active'";

    }
}