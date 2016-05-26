<?php
/**
 * Created by PhpStorm.
 * User: stu
 * Date: 2016/5/25
 * Time: 上午 10:38
 */

namespace daan_info_web\Presenters;

use daan_info_web\Repositories\teacherlistRepositories;
use daan_info_web\Repositories\teacherRepositories;
use daan_info_web\Repositories\gradeinfoRepositories;

use Crypt;

class teacherPresenters {

    protected $teacherlistRepositories;
    protected $teacherRepositories;
    protected $gradeinfoRepositories;

    public function __construct(teacherlistRepositories $teacherlistRepositories ,
                              teacherRepositories $teacherRepositories ,
                              gradeinfoRepositories $gradeinfoRepositories)
    {
        $this->teacherlistRepositories = $teacherlistRepositories;
        $this->teacherRepositories = $teacherRepositories;
        $this->gradeinfoRepositories = $gradeinfoRepositories;
    }

    public function getTeacher()
    {
        $Teacher = $this->teacherlistRepositories
                        ->getTeacher();
        $pic = array();
        $gradeinfo = array();
        $result = "";
        foreach($Teacher as $key => $teacher)
        {
            $pic[$key] = $this->teacherRepositories
                            ->getPic($teacher->acc);

            $gradeinfo[$key] = $this->gradeinfoRepositories
                                    ->getFromTeacherAndLatestYear($teacher->acc);


            $result .= '<div class="col-md-3" style="float:none;display:inline-block;">
                            <a href="teacher/' . $teacher->acc . '" style="text-decoration:none">
                                <img class="img-circle" src="' . asset($pic[$key]) . '" alt="Generic placeholder image" style="width:280px;height:280px">
                                <h4 style="font-weight:bold;margin:15px;">' . $teacher->name . '</h4>
                                <h5 style="margin-top:-15px;color:rgb(181, 181, 181);">' . $gradeinfo[$key] . '</h5>
                            </a>
                        </div>';
        }
        return $result;
    }
} 