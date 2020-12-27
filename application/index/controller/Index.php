<?php
namespace app\index\controller;
use think\Db;
use think\Request;

class Index
{
    /**
     * 列出所有的数据库
     */
    public function databases()
    {
        $list = Db::query('show databases;');
        return json($list);
    }

    /**
     * 列出数据库中的表
     * @param $db_name 数据库名称
     */
    public function tables($db_name)
    {
        $list = Db::query('select * from information_schema.tables where TABLE_SCHEMA="'.$db_name.'"');
        return json($list);
    }

    /**
     * 表节 构信息
     */
    public function tableInfo($db_name, $tb_name)
    {
        $data = Db::query('select * from information_schema.columns where TABLE_SCHEMA = "'.$db_name.'" and TABLE_NAME = "'.$tb_name.'"');
        return json($data);
    }

    /**
     * 更新 表注释
     */
    public function updateTableComment($db_name, $tb_name, Request $request)
    {
        $comment = $request->post('comment');
        $res = Db::execute("ALTER TABLE `{$db_name}`.`{$tb_name}` COMMENT = '{$comment}'");
        return json($res);
    }

    /**
     * 更新字 段注释
     */
    public function updateColumnComment($db_name, $tb_name, $column, Request $request)
    {
      $comment = $request->post('comment');
      $where = [
        ['TABLE_SCHEMA', '=', $db_name],
        ['TABLE_NAME', '=', $tb_name],
        ['COLUMN_NAME', '=', $column]
      ];
      $data = Db::table('information_schema.columns')->where($where)->find();
      $sql = "ALTER TABLE `{$db_name}`.`$tb_name` MODIFY COLUMN `{$column}`";
      $sql .= " {$data['COLUMN_TYPE']}";
      if($data['IS_NULLABLE'] === 'NO')
      {
        $sql .= " NOT NULL";
      }
      if($data['COLUMN_DEFAULT'] !== NULL)
      {
        $sql .= " DEFAULT '{$data['COLUMN_DEFAULT']}'";
      }
      $sql .= " COMMENT '{$comment}'";
      $res = Db::execute($sql);
      return json($res);
    }
}
