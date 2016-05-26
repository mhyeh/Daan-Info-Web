<?php

namespace daan_info_web\Repositories;

use daan_info_web\Gradeinfo;

class gradeinfoRepositories
{
    protected $gradeinfo;

    public function __construct(Gradeinfo $gradeinfo)
    {
        $this->gradeinfo = $gradeinfo;
    }

    public function insert($gradeNo ,$teacherNo ,$content)
    {
        //新增
        $info = new Gradeinfo;
        $info->gradeno = $gradeNo;
        $info->teacherno = $teacherNo;
        $info->content = $content;
        $info->save();
    }

    public function edit($gradeinfo)//傳json
    {
        //編輯
        foreach($gradeinfo as $grade)
        {
            $this->gradeinfo
                 ->where('idno', $grade->id)
                 ->update(['content'=>$grade->content]);
        }
    }

    public function delete($id)
    {
        //刪除
        $this->gradeinfo
             ->where('idno',$id)
             ->delete();
    }

    public function getFromYear($year)
    {
        return $this->gradeinfo
                   ->where('gradeno',$year)
                   ->get();
    }

    public function getFromTeacherAndYear($teacherno,$year)
    {
        return $this->gradeinfo
                   ->where('gradeno',$year)
                   ->where('teacherno',$teacherno)
                   ->get();
    }

    public function getFromTeacherAndLatestYear($teacherno)
    {
        $year = $this->gradeinfo
                     ->max('gradeno');
        $gradeinfo = $this->gradeinfo
                          ->where('teacherno',$teacherno)
                          ->where('gradeno',$year)
                          ->first();
        if($gradeinfo != Null)
            return $gradeinfo->content;
        else
            return 0;
    }


}