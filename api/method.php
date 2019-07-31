<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 7/4/19
 * Time: 8:03 PM
 */
ob_start();
session_start();

ini_set('max_execution_time', 600);
ini_set('memory_limit','1024M');

require '../config/DBConfig.php';
require '../src/Api.php';
require '../config/Auth.php';
require('../src/Queries.php');

require '../model/PhotoModel.php';

$db = new DBConfig();
$api = new Api();
$auth = new Auth();
$query = new Queries();
$model = new PhotoModel();

$user = $model->USERS;
$album = $model->ALBUM;
$photo = $model->PHOTOS;

$final = array();
$json = array();

$method = $api->getMethod();
$post = $api->getPostParams();
$get = $api->getUrlParams();
$files = $api->getFileParams();

if($method == 'user_login'){

    $stmt = $query->where($user,"user_name", $post['user_name']);

    $result = $db->conn->query($stmt)->fetch_assoc();

    if($result['id']>0){

        if($auth->comparePassword($post['password'], $result['password'])){

            $json['error'] = false;
            $json['data'] = $result;
        }
        else {

            $json['error'] = true;
            $json['data'] = "Invalid password";
        }
    }
    else{

        $json['error'] = true;
        $json['data'] = "Invalid username";
    }

    echo $api->returnData(array($json));
}
else if($method == 'album_list'){

    $photos = array();

    $stmt = $query->where($album,"user_id", $post['user_id']);

    $result = $db->conn->query($stmt) or die($db->conn->error);

    if($result->num_rows>0){

        while ($row = $result->fetch_assoc()){

            $photos = array();

            $photo = $db->conn->query($query->where("photos", "album_id",$row['id'])) or die($db->conn->error);

            while ($p_row = $photo->fetch_assoc()){

                array_push($photos, $p_row);
            }

            $row['photos'] = $photos;

            array_push($final, $row);
        }
    }

    echo $api->returnData($final);

}
else if($method =='album_download'){

    $zip = new ZipArchive;

    $fileName = $api->generateRandomString().'.zip';

    $album_name = $post['album'];

    $path = "../zips/".$fileName;
    try{

        if ($zip->open($path, ZipArchive::CREATE) === TRUE) {

            $i = 0;

            if ($handle = opendir('../photos/'.$album_name.'/')) {
                while (false !== ($file = readdir($handle))) {
                    if ('.' === $file) continue;
                    if ('..' === $file) continue;

                    $zip->addFile('../photos/'.$album_name.'/'.$file, $zip->getNameIndex($i));
                    $i++;
                }
                closedir($handle);
            }
        }
        else{

            echo "No directory";
        }

        $zip->close();

        echo  $fileName;

    }
    catch (Exception $e){

        echo ($e);
    }
}
else if($method == 'album_delete'){

    echo $query->delete($post['table_name'], $post['id']);

    $photo = $db->conn->query($query->delete($post['table_name'], $post['id']));

     if(mysqli_affected_rows($db->conn)>0){

         $_SESSION['status']='true';

         header("location: ../starter.php?page=list_album");
     }
     else{

         $_SESSION['status']='false';

         header("location: ../starter.php?page=list_album");
     }
}

else if($method == 'user_delete'){

    echo $query->delete($post['table_name'], $post['id']);

    $photo = $db->conn->query($query->delete($post['table_name'], $post['id']));

    if(mysqli_affected_rows($db->conn)>0){

        $_SESSION['status']='true';

        header("location: ../starter.php?page=list_user");
    }
    else{

        $_SESSION['status']='false';

        header("location: ../starter.php?page=list_user");
    }
}
else {

    $success = array();
    $error = array();

    if(!isset($post['album_id'])){

        array_push($error, "1");
    }
    else{

        $album_id = $post['album_id'];

        if (!is_dir($api->getPhotoAlbumPath($album_id))) {

            if(!mkdir($api->getPhotoAlbumPath($album_id), 0755, true)){

               // var_dump(error_get_last());
                array_push($error, "error");
            }
        }

        for($i=0; $i<count($_FILES['images']['name']); $i++){

            $file = $_FILES['images'];

            $fileinfo = pathinfo($file['name'][$i]);

            $file_name = strtotime("now").$api->generateRandomString();

            $file_path = $api->getPhotoAlbumPath($album_id).$file_name;

            $extension = '.' . $fileinfo['extension'];

            if (move_uploaded_file($file['tmp_name'][$i], $file_path . $extension)) {

                $columns = array('`photo_path`'=>"'".mysqli_real_escape_string($db->conn, $api->getPhotoURL($album_id).$file_path . $extension)."'",
                    '`album_id`'=>"'".mysqli_real_escape_string($db->conn, $album_id)."'");

                $stmt = $query->insert($photo,$columns);

                $result = $db->conn->query($stmt);

                if($result === TRUE){

                    array_push($success, $file['name'][$i]);
                }
                else{
                    array_push($error, $file['name'][$i]);
                }
            }
            else{

                array_push($error, $file['name'][$i]);
            }
        }
    }

    if(sizeof($error)>0){

        $_SESSION['status']='false';
    }
    else{

        $_SESSION['status']='true';
    }

    header("location: ../starter.php?page=add_photos");
}
