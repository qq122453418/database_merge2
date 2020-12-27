<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('api/databases', 'index/Index/databases');
Route::get('api/tables/db/:db_name', 'index/Index/tables');
Route::get('api/table_info/db/:db_name/tb/:tb_name', 'index/Index/tableInfo');
Route::post('api/update_table_comment/db/:db_name/tb/:tb_name', 'index/Index/updateTableComment');
Route::post('api/update_column_comment/db/:db_name/tb/:tb_name/column/:column', 'index/Index/updateColumnComment');
