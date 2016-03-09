<?php

namespace daan_info_web\Repositories;

use daan_info_web\Topicinfo;


class topicRepositories
{
    protected $topicinfo;

    public function __construct(Topicinfo $topicinfo)
    {
        $this->topicinfo = $topicinfo;
    }

    public function insert($groupno)
    {
        //新增
        $topic = new Topicinfo;
        $topic->groupno = $groupno;
        $topic->save();
    }

    public function edit($id,$title,$keyword,$type,$lastdate,$content,$wmv)
    {
        //編輯
        $this->topicinfo
            ->where('idno' ,$id)
            ->update(['topictitle' => $title ,'topickeyword' => $keyword ,
                        'topictype' => $type , 'lastdate' => $lastdate ,
                        'topiccontent' => $content , 'wmvpos' => $wmv]);
    }

    public function upload($id,$field,$path)
    {

        $this->topicinfo
            ->where('idno' ,$id)
            ->update([$field => $path]);
    }

    public function delete($id)
    {
        //刪除
        $this->topicinfo
            ->where('idno' ,$id)
            ->delete();
    }

    public function getAll()
    {
        return $this->topicinfo
                    ->get();
    }

    public function getFromId($id)
    {
        return $this->topicinfo
                    ->where('idno' ,$id)
                    ->get();
    }

    public function getGroupno($id)
    {
        $groupno =  $this->topicinfo
                        ->where('idno' ,$id)
                        ->get();
        return $groupno->groupno;
    }
}