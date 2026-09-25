<?php
spl_autoload_register(function($class){
    include $class . '.php';
});
define("MAX_SIZE", 30000000);
$upmsg = array();

if(isset($_POST['Submit'])){
    if ($_FILES['image']['name']){
        $imageName = $_FILES['image']['name'];
        $file = $_FILES['image']['tmp_name'];
        $imageType = getimagesize($file);
        if(($imageType[2] == 2)||($imageType[2] == 3)||($imageType[2] == 0)){
            $size = filesize($file);
            if($size<MAX_SIZE){
                $prefix = uniqid();
                $newName = $prefix . "_" . $imageName;
                $storeImage = "img/" . $newName;
                $resOBJ = new Resizer();
                $resOBJ->load($file);
                if( $_POST['resizetype'] == "height"){
                    $height = $_POST['size'];
                    $resOBJ->resizeToHeight($height);
                    $resOBJ->save($storeImage);
                }
            }
        }
    }

}

?>

<form name="imgup" method="post" enctype="multipart/form-data" action="">
    Image <input type="file" name="image">
    Resize to: <select name="resizetype">
        <option value="height">Height</option>
        <option value="width">Width</option>
        <option value="scale">Scale</option>
    </select>
    Size: <input type="text" name="size">
    <input name="Submit" type="submit" value="Upload">
</form>
