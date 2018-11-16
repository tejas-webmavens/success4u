<?php
    $site_datas = site_info();
    echo $this->db->last_query();
    echo "<br>";
    print_r($site_datas);
?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $site_datas['sitename'];?></title>
    <meta name="keywords" content="<?php echo $site_datas['sitemetakeyword'];?>"/>
    <meta name="description" content="<?php echo $site_datas['sitemetadescription'];?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">