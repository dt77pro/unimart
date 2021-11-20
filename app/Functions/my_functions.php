<?php

use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

function cate_parent ($data, $parent_id = 0, $str = '', $select = 0) {
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        if ($val['parent_id'] == $parent_id) {
            if ($select == $id) {
              echo "<option value='$id' selected ='selected'>$str $name</option>";
            } else {
              echo "<option value='$id'>$str $name</option>";
            }
            //Vòng lặp con tiếp tục
            cate_parent ($data, $id, $str."|---", $select);
        }
        
    }
}



function tablePostCategories($data, $parent_id = 0, $str = '') {

    foreach ($data as $key => $val) {
        $id = $val['id'];
        $name = $val['name'];
        $slug = $val['slug'];
        if ($val['parent_id'] == $parent_id)
        {
            if ($val['parent_id'] == 0) {
                echo '<tr>';
                    echo '<td>'.'<h6>'.$str . $name.'</h6>'.'</td>';
                    echo '<td>'.$slug.'</td>';
                    echo '<td>';
                        echo '<a href="'.route('post_cat.edit', $id).'" class="pr-1"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>';          
                        echo '<a href="'.route('post_cat.delete', $id).'" ><button class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Bạn có chắc chắn xóa danh mục này không?\')" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>';
                    echo '</td>';
                echo '</tr>';
 
            } else {
                echo '<tr>';
                    echo '<td>'.$str . $name.'</td>';
                    echo '<td>'.$slug.'</td>';
                    echo '<td>';
                        echo '<a href="'.route('post_cat.edit', $id).'" class="pr-1"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>';   
                        echo '<a href="'.route('post_cat.delete', $id).'" ><button class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Bạn có chắc chắn xóa danh mục này không?\')" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>';
                    echo '</td>';
                echo '</tr>';
            }
            unset($data[$key]);
            
            tablePostCategories($data, $id, $str.'|---');
        }
    }
}

function tableProductCategories($data, $parent_id = 0, $str = '') {

    foreach ($data as $key => $val) {
        $id = $val['id'];
        $name = $val['name'];
        $slug = $val['slug'];
        if ($val['parent_id'] == $parent_id)
        {
            if ($val['parent_id'] == 0) {
                echo '<tr>';
                    echo '<td>'.'<h6>'.$str . $name.'</h6>'.'</td>';
                    echo '<td>'.$slug.'</td>';
                    echo '<td>';
                        echo '<a href="'.route('cat_product.edit', $id).'" class="pr-1"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>';          
                        echo '<a href="'.route('cat_product.delete', $id).'" ><button class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Bạn có chắc chắn xóa danh mục này không?\')" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>';
                    echo '</td>';
                echo '</tr>';
 
            } 
            else {
                echo '<tr>';
                    echo '<td>'.$str . $name.'</td>';
                    echo '<td>'.$slug.'</td>';
                    echo '<td>';
                        echo '<a href="'.route('cat_product.edit', $id).'" class="pr-1"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>';          
                        echo '<a href="'.route('cat_product.delete', $id).'" ><button class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Bạn có chắc chắn xóa danh mục này không?\')" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>';
                    echo '</td>';
                echo '</tr>';
            }
            unset($data[$key]);
            
            tableProductCategories($data, $id, $str.'|---');
        }
    }
    
}

function tablePermissionCategories($data, $parent_id = 0, $str = '') {

    foreach ($data as $key => $val) {
        $id = $val['id'];
        $name = $val['name'];
        $display_name = $val['display_name'];
        $key_code = $val['key_code'];
        if ($val['parent_id'] == $parent_id)
        {
            if ($val['parent_id'] == 0) {
                echo '<tr>';
                    echo '<td>'.'<h6>'.$str . $name.'</h6>'.'</td>';
                    echo '<td>'.$display_name.'</td>';
                    echo '<td>'.$key_code.'</td>';
                    echo '<td>';
                        echo '<a href="'.route('permission.edit', $id).'" class="pr-1"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>';          
                        echo '<a href="'.route('permission.delete', $id).'" ><button class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Bạn có chắc chắn xóa danh mục này không?\')" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>';
                    echo '</td>';
                echo '</tr>';
 
            } 
            else {
                echo '<tr>';
                    echo '<td>'.$str . $name.'</td>';
                    echo '<td>'.$display_name.'</td>';
                    echo '<td>'.$key_code.'</td>';
                    echo '<td>';
                        echo '<a href="'.route('permission.edit', $id).'" class="pr-1"><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></button></a>';          
                        echo '<a href="'.route('permission.delete', $id).'" ><button class="btn btn-danger btn-sm rounded-0" onclick="return confirm(\'Bạn có chắc chắn xóa danh mục này không?\')" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></button></a>';
                    echo '</td>';
                echo '</tr>';
            }
            unset($data[$key]);
            
            tablePermissionCategories($data, $id, $str.'|---');
        }
    }
    
}

function data_tree($data, $parent_id = 0, $level = 0){
    $result = array();
    foreach($data as $item){
        if($item['parent_id'] == $parent_id){
            $item['level'] = $level;
            $result[] = $item;
            // unset($data[$item['id']]);
            $child = data_tree($data, $item['id'], $level+1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}


?>