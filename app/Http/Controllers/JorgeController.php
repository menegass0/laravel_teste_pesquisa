<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JorgeController extends Controller
{
    public function teste(){

        $queryUserHasThemeCategory = new UserHasThemeCategorySearch();
        $userHasThemeCategoryQuery = $queryUserHasThemeCategory->setSelect([
            'tb_school_user_has_tb_theme_category.*',
            'tb_school_user.*'
        ])->search()->joinUser()->joinUserGroup()->whereData([
            'studyId' => $studyId,
            'groupName' => 'ALUNO'
        ])->orderBy('tb_school_user_has_tb_theme_category.dt_initial_user_has_tb_theme_category', 'asc')->orderBy('tb_school_user.nm_user', 'asc')->finish(env('GET'));
        $userHasThemeCategoryDao = UserHasThemeCategoryDao::convertMany($userHasThemeCategoryQuery);
    }
}
