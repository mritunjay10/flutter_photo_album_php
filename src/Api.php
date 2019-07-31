<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 7/4/19
 * Time: 8:12 PM
 */

class Api
{

    public function getPostParams()
    {
        $temp = array();

        foreach ($_POST as $key => $value) {

            $temp[$key] = $value;
        }

        return $temp;
    }

    public function getUrlParams()
    {
        $temp = array();

        foreach ($_GET as $key => $value) {

            $temp[$key] = $value;
        }

        return $temp;
    }

    public function getFileParams()
    {
        $temp = array();

        foreach ($_FILES as $key => $value) {

            $temp[$key] = $value;
        }

        return $temp;
    }

    public function getMethod()
    {
        if(sizeof($_POST)>0)
            return $_POST['method'];
        else
            return null;
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getMethodType(){

        return $_SERVER['REQUEST_METHOD'];
    }

    public function returnData($value)
    {
        return json_encode($value, JSON_PRETTY_PRINT);
    }

    public function getAlbumPath(){

        return $_SERVER['DOCUMENT_ROOT'].'/PhotoAlbum/photos/albums/';
    }

    public function getPhotoPath(){

        return $_SERVER['DOCUMENT_ROOT'].'/PhotoAlbum/photos/';
    }

    public function getPhotoAlbumPath($id){

        return $_SERVER['DOCUMENT_ROOT'].'/PhotoAlbum/photos/'.$id.'/';
    }

    public function getAlbumURL(){

        return isset($_SERVER["HTTPS"]) ? 'https' : 'http'.'://'.$_SERVER['SERVER_NAME'].'/PhotoAlbum/photos/albums/';
    }

    public function getPhotoURL($id){

        return isset($_SERVER["HTTPS"]) ? 'https' : 'http'.'://'.$_SERVER['SERVER_NAME'].'/PhotoAlbum/photos/'.$id.'/';
    }
}